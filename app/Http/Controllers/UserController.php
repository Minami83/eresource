<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
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
        $listUser = User::get();
        $data = Auth()->user();
        return view('adminlayouts/userlist')->with('userList',$listUser)->with('user',$data);
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
        $user->password = bcrypt($data['password']);
        $user->save();
        $user->roles()->detach();
        $user
            ->roles()
            ->attach(Role::where('name',$data['role'])->first());
        $user->save();
        return redirect('/admin/user/list');

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
        $user = User::where('id',$id)->first();
        $data = $request->all();
        $user->nrp = $data['nrp'];
        $user->name = $data['name'];
        $user->faculty = $data['faculty'];
        $user->department = $data['department'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->roles()->detach();
        $user
            ->roles()
            ->attach(Role::where('name',$data['role'])->first());
        $user->save();
        $url = '/admin/user/detail/'.(string)$id;
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
        $user = User::where('id',$id)->first();
        $user->delete();
        return redirect('/admin/user/list');
    }
}
