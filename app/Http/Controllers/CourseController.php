<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Request;
use App\Jurnal;
use App\Log;
use App\Pretest;
use App\Posttest;
use Illuminate\Support\Facades\DB;
class CourseController extends Controller
{
    //

    private $progressRecord;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pretest()
    {
        $user = Auth()->user();
        $pretest_quest = Pretest::get();
        $myJurnal = $user->takenJurnalList();
        $url = 'course/'.$myJurnal[0]->name;
        // if($user->progress != 0) return redirect($url)->with('user',$user)->with('myJurnal',$myJurnal);
        if($user->progress != 0) return redirect('/home')->with('user',$user);
        // dd($pretest_quest);
        return view('webpage/pretest')->with('user',$user)->with('pretest',$pretest_quest);
    }

    public function preAns(Request $request)
    {
        $user = Auth()->user();
        $ans = $request->all();
        // dd($ans);
        $pretest_quest = Pretest::get();
        foreach($pretest_quest as $quest){
            $user->pretests()->attach($quest, ['answer' => $ans[$quest->id] ]);
        }
        $myJurnal = $user->takenJurnalList();
        $url = 'course/'.$myJurnal[0]->name;
        $user->progress = 1;
        $user->save();
        return redirect($url)->with('user',$user)->with('myJurnal', $myJurnal);
    }

    public function posttest()
    {
        $user = Auth()->user();
        $posttest_quest = Posttest::get();
        if($user->progress < $user->takenJurnalList()->count()) return redirect('/home');
        if($user->verified == 2) return redirect('/home')->with('user',$user);
        return view('webpage/posttest')->with('user',$user)->with('posttest',$posttest_quest);
    }

    public function postAns(Request $request)
    {
        // dd($request->all());
        $user = Auth()->user();
        $ans = $request->all();
        $posttest_quest = Posttest::get();
        foreach($posttest_quest as $quest){
            $user->posttests()->attach($quest, ['answer' => $ans[$quest->id] ]);
        }
        $myJurnal = $user->takenJurnalList();
        $url = 'course/'.$myJurnal[0]->name;
        $user->verified = 2;
        $user->progress = $user->progress + 1;
        $user->save();
        // return redirect($url)->with('user',$user)->with('myJurnal', $myJurnal);
        return redirect('/home');
    }

    public function testscore()
    {
        $user = Auth()->user();
        $preAns = DB::table('pretest_user')->where('user_id',$user->id)->get();
        $postAns = DB::table('posttest_user')->where('user_id',$user->id)->get();
        $test = Pretest::get();
        // dd($preAns);
        $preScore = 0;
        $postScore = 0;
        for($i=0;$i<$test->count();$i++){
            if($test[$i]->right_answer==1) $truAns[$i] = $test[$i]->choice_1;
            if($test[$i]->right_answer==2) $truAns[$i] = $test[$i]->choice_2;
            if($test[$i]->right_answer==3) $truAns[$i] = $test[$i]->choice_3;
            if($test[$i]->right_answer==4) $truAns[$i] = $test[$i]->choice_4;
            if($preAns[$i]->answer==$truAns[$i]) $preScore = $preScore + 1;
            if($postAns[$i]->answer==$truAns[$i]) $postScore = $postScore + 1;
        }
        return view('webpage/testscore')->with('user',$user)->with('preAns',$preAns)->with('postAns',$postAns)->with('test',$test)->with('preScore',$preScore)->with('postScore',$postScore)->with('truAns',$truAns);
    }


    public function sertifPage()
    {
        $user = Auth()->user();
        if($user->verified != 2 && $user->progress < $user->takenJurnalList()->count()) return redirect('/home');
        $date = date('d-m-y');
        $path = public_path().'/image/dummySertif.jpg';
        $image = imagecreatefromjpeg($path);
        // bikin warna text r g b format
        $color = imagecolorallocate($image, 0, 0, 0);
        $string = $user->name;
        $string1 = "atas partisipasinya dalam menyelesaikan";
        $string2 = "E-Resource Class";
        $font = public_path().'/font/Certificate.ttf';
        $font1 = public_path().'/font/CALIFR.TTF';
        $font2 = public_path().'/font/timesbi.ttf';
        $box=imageftbbox(40, 0, $font, $string);
        $box1=imageftbbox(20, 0, $font1, $string1);
        $box2=imageftbbox(30, 0, $font2, $string2);
        $x = (1024 - ($box[2]-$box[0]))/2;
        $x1 = (1024 - ($box1[2]-$box1[0]))/2;
        $x2 = (1024 - ($box2[2]-$box2[0]))/2;
        $x3 = 255;
        $y = 390;
        $y1 = 430;
        $y2 = 470;
        $y3 = 525;
        // write on the image
        imagettftext($image, 40, 0, $x, $y, $color, $font, $string);
        imagettftext($image, 20, 0, $x1, $y1, $color, $font1, $string1);
        imagettftext($image, 30, 0, $x2, $y2, $color, $font2, $string2);
        imagettftext($image, 20, 0, $x3, $y3, $color, $font, $date);
        // save the image
        $img = '/image/'.$user->name.'.jpg';
        imagejpeg($image,  $fileName = public_path().$img, $quality = 100);
        // return redirect('/home');
        return view('webpage/sertifikat')->with('user',$user)->with('date',$date)->with('img_url',$img);
    }

    public function index(Request $request)
    {
        // dd($request);
        $user = Auth()->user();
        $jurnal = Jurnal::get();
        if($user->verified==0) return view('error/403');
        $myJurnal = $user->takenJurnalList();
        if($user->progress == 0)
          return $this->pretest();
        $now = substr($request->path(),7);
        $nowProgress = $myJurnal->pluck('name')->search($now);
        // dd($nowProgress);
        $index = ($user->progress>$nowProgress)?$nowProgress:$user->progress-1;
        if($nowProgress===false) $index = $user->progress-1;
        // dd($index);
        $text = file(public_path().$myJurnal[$index]->howto);
        if($nowProgress === false || $nowProgress>$user->progress){
            $url = 'course/'.$myJurnal[$index]->name;
            return redirect($url)->with('index',$index);
        }
        $url = 'jurnal/'.$myJurnal[$index]->name;
        $compl = DB::table('jurnal_user')->where('user_id',$user->id)->where('completed',1.0)->count();
        $prog = (float)$compl/(float)$myJurnal->count();
        $log = new Log();
        $log->user_id = $user->id;
        $log->jurnal_id = $myJurnal[$index]->id;
        $log->activity = 'Masuk Ke '.$myJurnal[$index]->fullName;
        $log->save();
        // dd($prog);
        // return view($url)->with('user',$user)->with('myJurnal',$myJurnal)->with('jurnal',$jurnal)->with('howto_text',$text)->with('index',$index);
        return view('webpage/mastercourse')->with('user',$user)->with('myJurnal',$myJurnal)->with('jurnal',$jurnal)->with('howto_text',$text)->with('index',$index)->with('progress',$prog);
    }


    public function nextPage(Request $request)
    {
        $user = Auth()->user();
        if($user->verified==0) return view('error/403');
        $callerJurnal = Jurnal::where('name', request('url'))->first();
        $myJurnal = $user->takenJurnalList();


        $this->incAction(request('accord1input'),request('accord2input'),request('accord3input'),$user, $callerJurnal);

        $currentProgress = $myJurnal->pluck('name')->search(request('url'));
        $user->jurnals()->updateExistingPivot($myJurnal[$currentProgress],array('completed' => 1),false);
        // dd($currentProgress);
        if($user->progress == $currentProgress+1)
        {
            $user->progress = $user->progress + 1;
            if($user->progress > $myJurnal->count()){
                // $user->progress = $user->progress - 1;
                // $user->save();
                return $this->posttest();
            }
            $user->save();
            $text = file(public_path().$myJurnal[$currentProgress+1]->howto);
            $url = 'course/'.$myJurnal[$currentProgress+1]->name;
            $index = $currentProgress+1;
        }
        else{
            // dd($myJurnal->count());
            $currentProgress = $currentProgress + 1;
            // dd($currentProgress);
            if($currentProgress >= $myJurnal->count()) return $this->posttest();
            $url = 'course/'.$myJurnal[$currentProgress]->name;
            $text = file(public_path().$myJurnal[$currentProgress]->howto);
            $index = $currentProgress;
        }
        // dd($url);
        // return redirect($url)->with('user',$user)->with('myJurnal',$myJurnal)->with('howto_text',$text);
        $log = new Log();
        $log->user_id = $user->id;
        $log->jurnal_id = $callerJurnal->id;
        $log->activity = 'Menyelesaikan '.$callerJurnal->fullName;
        $log->save();
        return redirect($url)->with('user',$user)->with('myJurnal',$myJurnal)->with('howto_text',$text)->with('index',$index);
    }

    public function continue()
    {
        $user = Auth()->user();
        $myJurnal = $user->takenJurnalList();
        if($myJurnal->count()==0) return redirect('/home')->with('alert','User tidak mempunyai Jurnal');
        // $index = ($user->verified==2)?$user->progress-2:$user->progress-1;
        $index = DB::table('jurnal_user')->where('user_id',$user->id)->where('completed',1)->count()-1;
        if($index<0) $index=0;
        $url = 'course/'.$myJurnal[$index]->name;
        $text = file(public_path().$myJurnal[$index]->howto);
        $jurnal = Jurnal::get();
        return redirect($url)->with('user',$user)->with('myJurnal',$myJurnal)->with('howto_text',$text)->with('jurnal',$jurnal)->with('index',$index);
    }

    public function incAction(int $howto, int $video, int $tutorial, $user, $jurnal)
    {
        if($howto==1){
            $log = new Log();
            $log->user_id = $user->id;
            $log->jurnal_id = $jurnal->id;
            $log->activity = 'How to';
            $log->save();
        }
        if($video==1){
            $log = new Log();
            $log->user_id = $user->id;
            $log->jurnal_id = $jurnal->id;
            $log->activity = 'Video';
            $log->save();
        }
        if($tutorial==1){
            $log = new Log();
            $log->user_id = $user->id;
            $log->jurnal_id = $jurnal->id;
            $log->activity = 'Tutorial';
            $log->save();
        }
    }
}
