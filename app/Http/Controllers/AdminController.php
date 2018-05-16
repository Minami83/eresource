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
    $request->user()->authorizeRoles('admin');
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
}
