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
        return view('adminlayout/jurnallist')->with('jurnal',$jurnal);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adminlayout/makejurnal');
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
        $jurnal = new Jurnal();
        $jurnal->name = $data['name'];
        $jurnal->fullName = $data['fullName'];

        $howto = $request->file('howto');
        $filename = $howto->getClientOriginalName();
        $destination = public_path().'/howto';
        $howto->move($destination,$filename);
        $jurnal->howto = $destination.'/'.$filename;
        $video = $request->file('video');
        $filename = $howto->getClientOriginalName();
        $destination = public_path().'/video';
        $video->move($destination,$filename);
        $jurnal->video = $destination.'/'.$filename;
        $jurnal->save();
        return redirect('/jurnal/list');

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
        $jurnal = Jurnal::where('id',$id)->first();
        return view('adminlayout/jurnaldetail')->with('jurnal',$jurnal);
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
        $jurnal = Jurnal::where('id',$id)->first();
        return view('adminlayout/jurnaledit')->with('jurnal',$jurnal);
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
        $data = $request->all();
        $jurnal = Jurnal::where('id',$id)->first();
        $jurnal->name = $data['name'];
        $jurnal->fullName = $data['fullName'];
        $howto = $request->file('howto');
        $filename = $howto->getClientOriginalName();
        $destination = public_path().'/howto';
        $howto->move($destination,$filename);
        $jurnal->howto = $destination.'/'.$filename;
        $video = $request->file('video');
        $filename = $howto->getClientOriginalName();
        $destination = public_path().'/video';
        $video->move($destination,$filename);
        $jurnal->video = $destination.'/'.$filename;
        $jurnal->save();
        $url = '/admin/jurnal/detail/'.string($id);
        return redirect($url)->with('jurnal',$jurnal);
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
    }
}
