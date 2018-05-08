<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pretest;
use App\Posttest;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $test = Pretest::get();
        return view('adminlayout/testlist')->with('test',$test);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adminlayout/maketest');
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
        $pretest = new Pretest();
        $pretest->question = $data['question'];
        $pretest->choice_1 = $data['choice_1'];
        $pretest->choice_2 = $data['choice_2'];
        $pretest->choice_3 = $data['choice_3'];
        $pretest->choice_4 = $data['choice_4'];
        $pretest->save();
        $posttest = new Posttest();
        $posttest->question = $data['question'];
        $posttest->choice_1 = $data['choice_1'];
        $posttest->choice_2 = $data['choice_2'];
        $posttest->choice_3 = $data['choice_3'];
        $posttest->choice_4 = $data['choice_4'];
        $posttest->save();
        return redirect('test/list');
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
        $test = Pretest::where('id',$id)->first();
        return view('adminlayout/testdetail')->with('test',$test);
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
        $test = Pretest::where('id',$id)->first();
        return view('adminlayout/testedit')->with('test',$test);
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
        $pretest = Pretest::where('id',$id)->first();
        $pretest->question = $data['question'];
        $pretest->choice_1 = $data['choice_1'];
        $pretest->choice_2 = $data['choice_2'];
        $pretest->choice_3 = $data['choice_3'];
        $pretest->choice_4 = $data['choice_4'];
        $pretest->save();
        $posttest = Posttest::where('id',$id)->first();
        $posttest->question = $data['question'];
        $posttest->choice_1 = $data['choice_1'];
        $posttest->choice_2 = $data['choice_2'];
        $posttest->choice_3 = $data['choice_3'];
        $posttest->choice_4 = $data['choice_4'];
        $posttest->save();
        $url = 'admin/test/detail'.string($id);
        return redirect($url)->with('test',$pretest);
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
        $pretest = Pretest::where('id',$id)->first();
        $pretest->delete();
        $posttest = Posttest::where('id',$id)->first();
        $posttest->delete();
    }
}
