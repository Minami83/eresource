<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return redirect('course/asce')->with('user',$data);
        return view('webpage/mastercourse')->with('user',$data);
    }
    public function adminIndex(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        // return view('adminHome');
    }
}
