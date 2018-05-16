<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Jurnal;
class AdminController extends Controller
{
    //
  public function Index(Request $request)
  {
    $request->user()->authorizeRoles(['admin','pustakawan']);
    $data = Auth()->user();
    $unverified = DB::table('users')->where('verified',0)->get();
    $jurnal1 = Jurnal::where('id','<=',Jurnal::count()/2)->get();
    $jurnal2 = Jurnal::where('id','>',Jurnal::count()/2)->get();
    // dd($jurnal);
    return view('adminlayouts/registereduser')->with('user',$data)->with('unverified',$unverified)->with('jurnal1',$jurnal1)->with('jurnal2',$jurnal2);
  }

  public function verify(Request $request)
  {
    $data = $request->all();
    // dd($data);
    $reguser = User::where('email',$data['email'])->first();
    foreach($data as $d){
        $jurn = Jurnal::where('name',$d)->first();
        if($jurn==null) continue;
        $reguser->jurnals()->attach($jurn,['completed' => 0]);
    }
    $reguser->verified = 1;
    $reguser->save();
    return redirect('/admin');

  }

  public function recap()
  {
    $admin = Auth()->user();
    $users = User::get();
    $regUser = ['01'=>[],'02'=>[],'03'=>[],'04'=>[],'05'=>[],'06'=>[],'07'=>[],'08'=>[],'09'=>[],'10'=>[],'11'=>[],'12'=>[]];
    $compUser = ['01'=>[],'02'=>[],'03'=>[],'04'=>[],'05'=>[],'06'=>[],'07'=>[],'08'=>[],'09'=>[],'10'=>[],'11'=>[],'12'=>[]];
    foreach($users as $user){
      $month = $user->created_at->format('m');
      array_push($regUser[$month],$user);
    }
    // dd($regUser);
    foreach($users as $user){
      if($user->verified != 2) continue;
      $month = $user->updated_at->format('m');
      array_push($compUser[$month],$user);
    }
    // dd($compUser);
    return view('adminlayout/laporan')->with('user',$admin)->with('regis_user',$regUser)->with('compl_user',$compUser);
  }

}
