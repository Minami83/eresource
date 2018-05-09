<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurnal;
class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jurnal = Jurnal::get();
        $admin = Auth()->user();
        $admin->authorizeRoles(['admin']);
        return view('adminlayouts/jurnallist')->with('jurnal',$jurnal)->with('user',$admin);

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
        return view('adminlayouts/makejurnal')->with('user',$admin);
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
        $jurnal = new Jurnal();
        $jurnal->name = $data['name'];
        $jurnal->fullName = $data['fullName'];

        $howto = $request->file('howto');
        // dd($howto);
        $filename = $howto->getClientOriginalName();
        $destination = public_path().'/howto';
        $howto->move($destination,$filename);
        $jurnal->howto = '/howto/'.$filename;
        $video = $request->file('video');
        $filename = $video->getClientOriginalName();
        $destination = public_path().'/video';
        $video->move($destination,$filename);
        $jurnal->video = '/video/'.$filename;
        $jurnal->save();
        return redirect('/admin/jurnal/list')->with('user',$admin);

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
        $admin = Auth()->user();
        $admin->authorizeRoles(['admin']);
        $jurnal = Jurnal::where('id',$id)->first();
        return view('adminlayouts/jurnaldetail')->with('jurnal',$jurnal)->with('user',$admin);
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
        $admin = Auth()->user();
        $admin->authorizeRoles(['admin']);
        $jurnal = Jurnal::where('id',$id)->first();
        return view('adminlayouts/jurnaledit')->with('jurnal',$jurnal)->with('user',$admin);
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
        $data = $request->all();
        $jurnal = Jurnal::where('id',$id)->first();
        $jurnal->name = $data['name'];
        $jurnal->fullName = $data['fullName'];
        $howto = $request->file('howto');
        $filename = $howto->getClientOriginalName();
        $destination = public_path().'/howto';
        $howto->move($destination,$filename);
        $jurnal->howto = '/howto/'.$filename;
        $video = $request->file('video');
        $filename = $howto->getClientOriginalName();
        $destination = public_path().'/video';
        $video->move($destination,$filename);
        $jurnal->video = '/video/'.$filename;
        $jurnal->save();
        $url = '/admin/jurnal/detail/'.$id;
        return redirect($url)->with('jurnal',$jurnal)->with('user',$admin);
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
        $jurnal = Jurnal::where('id',$id)->first();
        $jurnal->delete();
        return redirect('/admin/jurnal/list');
    }
}
