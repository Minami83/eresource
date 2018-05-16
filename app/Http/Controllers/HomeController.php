<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['student','admin']);
        $data = Auth()->user();
        $this->loginlog();
        if($data->verified==0) return view('adminlayouts/dummy')->with('user',$data);
        $myJurnal = $data->takenJurnalList();
        // dd($data);
        // dd($data);
        // return redirect('course/asce')->with('user',$data)->with('myJurnal',$myJurnal);
        return view('webpage/home')->with('user',$data);
    }

    public function profile()
    {
        $user = Auth()->user();
        return view('webpage/profile')->with('user',$user);
    }

    public function change(Request $request)
    {
        $user = Auth()->user();
        $data = $request->all();
        $user->nrp = $data['nrp'];
        $user->name = $data['name'];
        $user->faculty = $data['faculty'];
        $user->department = $data['department'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->save();
        return $this->profile();
    }

    public function viewChangePass()
    {
        $user = Auth()->user();
        return view('webpage/changepass')->with('user',$user)->with('alert',null);
    }

    public function changePass(Request $request)
    {
        $user = Auth()->user();
        $data = $request->all();
        // dd(bcrypt($data['oldpass']));
        if(!(Hash::check($data['oldpass'],$user->password))){
            // echo ("<script LANGUAGE='JavaScript'>
            //         window.alert('wrong old password');
            //         window.location.href='/profile/password';
            //         </script>");
            return redirect('/profile/password')->with('alert','password lama salah');
        }
        elseif($data['newpass'] != $data['password_confirmation']){
            // echo ("<script LANGUAGE='JavaScript'>
            //         window.alert('password confirmation does not match');
            //         window.location.href='/profile/password';
            //         </script>");
            return redirect('/profile/password')->with('alert','password baru tidak sama');
        }
        else{
            $user->password = bcrypt($data['newpass']);
            $user->save();
            // echo ("<script LANGUAGE='JavaScript'>
            //         window.alert('password change completed');
            //         window.location.href='/profile/password';
            //         </script>");
            return redirect('/profile/password')->with('alert','password telah terganti');
        }
    }

    public function loginlog()
    {
        $user = Auth()->user();
        $log = new Log();
        $log->user_id = $user->id;
        $log->jurnal_id = 0;
        $log->activity = 'Login';
        $log->save();
    }

    public function logoutlog()
    {
        $user = Auth()->user();
        $log = new Log();
        $log->user_id = $user->id;
        $log->jurnal_id = 0;
        $log->activity = 'Login';
        $log->save();
        Auth()->logout();
    }

    public function errorPage()
    {
        $user = Auth()->user();
        return view('error/403')->with('user',$user);
    }

}
