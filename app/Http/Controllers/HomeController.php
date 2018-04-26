<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
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
        // dd($data);
        // dd($data);
        return redirect('course/asce')->with('user',$data);
        return view('webpage/mastercourse')->with('user',$data);
    }
    public function adminIndex(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $data = Auth()->user();
        $howto = DB::table('users')->sum('how_to');
        $video = DB::table('users')->sum('video');
        $tutorial = DB::table('users')->sum('tutorial');
        $chartData = collect(['howto' => $howto, 'video' => $video, 'tutorial' => $tutorial]);
        // dd($chartData);
        return view('adminlayouts/statistic')->with('user',$data)->with('data',$chartData);
    }
}
