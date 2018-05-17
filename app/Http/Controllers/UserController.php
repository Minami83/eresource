<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Jurnal;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = Auth()->user();
        $listUser = User::where('id', '!=', $admin->id)->get();
        $admin->authorizeRoles(['admin','pustakawan']);
        return view('adminlayouts/userlist')->with('userList',$listUser)->with('user',$admin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $admin = Auth()->user();
        $admin->authorizeRoles(['admin']);

        return view('adminlayouts/makeuser')->with('user',$admin);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $admin = Auth()->user();
        $admin->authorizeRoles(['admin']);
        $data = $request->all();
        $user = new User();
        $user->id_number = $data['nrp'];
        $user->name = $data['name'];
        $user->faculty = $data['faculty'];
        $user->department = $data['department'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->progress = 0;
        $user->verified = 0;

        if($data['role']=='admin' or $data['role']=='pustakawan'){
            $user->verified = 2;
            $jurnalCnt = Jurnal::count();
            $user->progress = $jurnalCnt+1;
            $jurnal = Jurnal::get();
            foreach($jurnal as $jur){
                $user->jurnals()->attach($jur);
            }
        }

        $user->password = bcrypt($data['password']);
        $user->save();
        $user->roles()->detach();
        $user
            ->roles()
            ->attach(Role::where('name',$data['role'])->first());
        $user->save();
        return redirect('/admin/user/list')->with('user',$admin);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::where('id',$id)->first();
        $admin = Auth()->user();
        $admin->authorizeRoles(['admin','pustakawan']);
        $myJurnal = $user->takenJurnalList();
        $jurnal1 = Jurnal::where('id','<=',Jurnal::count()/2)->get();
        $jurnal2 = Jurnal::where('id','>',Jurnal::count()/2)->get();
        return view('adminlayouts/userdetail')->with('edituser',$user)->with('user',$admin)->with('myJurnal',$myJurnal)->with('jurnal1',$jurnal1)->with('jurnal2',$jurnal2);
    }

    public function showTest($id)
    {
        $admin = Auth()->user();
        $user = User::where('id',$id)->first();
        $preAns = DB::table('pretest_user')->where('user_id',$user->id)->get('answer');
        $postAns = DB::table('posttest_user')->where('user_id',$user->id)->get('answer');
        $test = Pretest::get();
        $preScore = 0;
        $postScore = 0;
        for($i=0;i<$test->count();$i++){
            if($test[$i]->right_answer==1) $truAns = $test[$i]->choice_1;
            if($test[$i]->right_answer==2) $truAns = $test[$i]->choice_2;
            if($test[$i]->right_answer==3) $truAns = $test[$i]->choice_3;
            if($test[$i]->right_answer==4) $truAns = $test[$i]->choice_4;
            if($preAns[$i]==$truAns) $preScore = $preScore + 1;
            if($postAns[$i]==$truAns) $postScore = $postScore + 1;
        }
        return view('webpage/testScore')->with('user',$admin)->with('preAns',$preAns)->with('postAns',$postAns)->with('test',$test)->with('preScore',$preScore)->with('postScore',$postScore)->with('showeduser',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::where('id',$id)->first();
        $admin = Auth()->user();
        $admin->authorizeRoles(['admin','pustakawan']);
        $myJurnal = $user->takenJurnalList();
        return view('adminlayouts/useredit')->with('edituser',$user)->with('user',$admin)->with('myJurnal',$myJurnal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $admin = Auth()->user();
        $admin->authorizeRoles(['admin','pustakawan']);
        $user = User::where('id',$id)->first();
        $data = $request->all();
        $user->id_number = $data['nrp'];
        $user->name = $data['name'];
        $user->faculty = $data['faculty'];
        $user->department = $data['department'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];

        if($data['role']=='admin'){
            $user->verified = 2;
            $jurnalCnt = Jurnal::count();
            $user->progress = $jurnalCnt+1;
            $user->jurnals()->detach();
            $jurnal = Jurnal::get();
            foreach($jurnal as $jur){
                $user->jurnals()->attach($jur);
            }
        }

        $user->roles()->detach();
        $user
            ->roles()
            ->attach(Role::where('name',$data['role'])->first());
        $user->save();
        $url = '/admin/user/detail/'.$id;
        return redirect($url)->with('edituser',$user)->with('user',$admin);
    }

    public function updateJurnal(Request $request,$id)
    {
        $admin = Auth()->user();
        $user = User::where('id',$id)->first();
        $data = $request->all();
        $user->jurnals()->detach();
        dd($data);
        foreach($data as $dat)
        {
            $jurn = Jurnal::where('name',$dat)->first();
            if($jurn==null) continue;
            $user->jurnals()->attach($jurn,['completed' => 0]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = Auth()->user();
        if($id == $admin->id) return redirect('/admin/user/list');
        $user = User::where('id',$id)->first();
        $user->delete();
        return redirect()->back();
    }
}
