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
        $jurnal = Jurnal::paginate(10);
        $admin = Auth()->user();
        $admin->authorizeRoles(['admin','pustakawan']);
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
        // if(Jurnal::where('name',$data['name'])->exists())
        //     return redirect('/admin/jurnal/list')->with('alert','Sudah ada jurnal dengan nama yang sama');
        $validat = $request->validate([
            'name' => 'required|unique:jurnals',
            'fullName' => 'required|unique:jurnals'
        ]);
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
        $admin->authorizeRoles(['admin','pustakawan']);
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
        if($data['name'] !== $jurnal->name){
            $validat_name = $request->validate([
                'name' => 'required|unique:jurnals'
            ]);
        }
        else {
            $validat_name = $request->validate([
                'name' => 'required'
            ]);
        }
        if($data['fullName'] !== $jurnal->fullName){
            $validat_fullNamee = $request->validate([
                'fullName' => 'required|unique:jurnals'
            ]);
        }
        else {
            $validat_fullName = $request->validate([
                'fullName' => 'required'
            ]);
        }
        $jurnal->name = $data['name'];
        $jurnal->fullName = $data['fullName'];
        $howto = $request->file('howto');
        if($howto != null){
            $filename = $howto->getClientOriginalName();
            $destination = public_path().'/howto';
            $howto->move($destination,$filename);
            $jurnal->howto = '/howto/'.$filename;
        }
        $video = $request->file('video');
        if($video != null){
            $filename = $howto->getClientOriginalName();
            $destination = public_path().'/video';
            $video->move($destination,$filename);
            $jurnal->video = '/video/'.$filename;
        }
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
