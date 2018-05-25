<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Jurnal;
use App\Log;
use Illuminate\Support\Facades\File;
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
    if($unverified->count()==0){
      return redirect('/admin/user/list')->with('alert','Tidak ada user yang belum terverifikasi');
    }
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

  public function recap($year)
  {
    $admin = Auth()->user();
    if($admin->hasRole('pustakawan'))
      $users = User::where('department',$admin->department)->whereYear('created_at',$year)->get();
    else
      $users = User::whereYear('created_at',$year)->get();
    $regUser = ['01'=>[],'02'=>[],'03'=>[],'04'=>[],'05'=>[],'06'=>[],'07'=>[],'08'=>[],'09'=>[],'10'=>[],'11'=>[],'12'=>[]];
    $compUser = ['01'=>[],'02'=>[],'03'=>[],'04'=>[],'05'=>[],'06'=>[],'07'=>[],'08'=>[],'09'=>[],'10'=>[],'11'=>[],'12'=>[]];


    foreach($users as $user){
      $month = $user->created_at->format('m');
      array_push($regUser[$month],$user);
    }

    foreach($users as $user){
      if($user->verified != 2) continue;
      $month = $user->updated_at->format('m');
      array_push($compUser[$month],$user);
    }

    return view('adminlayouts/laporan')->with('user',$admin)->with('regis_user',$regUser)->with('compl_user',$compUser);
  }

  public function logReport()
  {
    $admin = Auth()->user();
    $log = Log::get();
    // dd($log);
    return view('adminlayouts/logreport')->with('user',$admin)->with('logReport',$log);
  }

  public function statistik()
  {
    $admin = Auth()->user();
    $users = User::get();
    $count = []; //jumlah jurnal yang diambil orang"
    $jurnals = Jurnal::get();
    foreach($jurnals as $jurnal){
      $cnt = DB::table('jurnal_user')->where('jurnal_id',$jurnal->id)->count();
      array_push($count,$cnt);
    }
    $loginActivity = [];
    for($i=1; $i<=12 ; $i++){
      $cnt = Log::whereYear('created_at',date('Y'))->whereMonth('created_at','0'.$i)->count();
      array_push($loginActivity, $cnt);
    }
    $mhsdosen = [];
    $mhs = User::whereRaw('LENGTH(id_number) = 14')->count();
    array_push($mhsdosen,$mhs);
    $dosen = User::whereRaw('LENGTH(id_number) = 18')->count();
    array_push($mhsdosen,$dosen);
    // dd($mhsdosen);
    return view('adminlayouts/statistic')->with('user',$admin)->with('jurnalCount',$count)->with('loginCount',$loginActivity)->with('mhsdosenCount',$mhsdosen);
  }

}
