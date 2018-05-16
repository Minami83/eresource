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
        $admin->authorizeRoles(['admin']);
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
        $user->nrp = $data['nrp'];
        $user->name = $data['name'];
        $user->faculty = $data['faculty'];
        $user->department = $data['department'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->progress = 0;
        $user->verified = 0;
        if($data['role']=='admin'){
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
        $admin->authorizeRoles(['admin']);
        return view('adminlayouts/userdetail')->with('edituser',$user)->with('user',$admin);
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
        $admin->authorizeRoles(['admin']);
        return view('adminlayouts/useredit')->with('edituser',$user)->with('user',$admin);
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
        $admin->authorizeRoles(['admin']);
        $user = User::where('id',$id)->first();
        $data = $request->all();
        $user->nrp = $data['nrp'];
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
