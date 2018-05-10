<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Request;
use App\Jurnal;
use App\Log;
use App\Pretest;
use App\Posttest;
class CourseController extends Controller
{
    //

    private $progressRecord;

    public function __construct()
    {
        $this->middleware('auth');
        $this->progressRecord = collect([
        'pretest' => 0,
        'asce' => 1,
        'asme' => 2,
        'melp' => 3,
        'tnarina' => 4,
        'sbidrina' => 5,
        'smdrina' => 6,
        'ijme' => 7,
        'ijsct' => 8,
        'jspd' => 9,
        'jsr' => 10,
        'marinetech' => 11,
        'springerlink' => 12,
        'emerald' => 13,
        'gale' => 14,
        'ieee' => 15,
        'ebsco' => 16,
        'proquest' => 17,
        'sciencedir' => 18,
        'nature' => 19,
        'posttest' => 20]);
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
        $user->save();
        // return redirect($url)->with('user',$user)->with('myJurnal', $myJurnal);
        return redirect('/home');
    }

    public function sertifPage()
    {
        $user = Auth()->user();
        if($user->verified != 2) return redirect('/home');
        $date = date('d-m-y');
        $path = public_path().'/image/dummySertif.jpg';
        $image = imagecreatefromjpeg($path);
        // bikin warna text r g b format
        $color = imagecolorallocate($image, 0, 0, 0);
        $string = $user->name;
        $x = 420;
        $y = 400;
        $font = public_path().'/font/Certificate.ttf';
        // write on the image
        imagettftext($image, 75, 0, $x, $y, $color, $font, $string);
        // save the image
        $img = '/image/'.$user->name.'.jpg';
        imagejpeg($image,  $fileName = public_path().$img, $quality = 100);
        return redirect('/home');
        return view('webpage/sertifikat')->with('user',$user)->with('date',$date)->with('img_url',$img);
    }

    public function index(Request $request)
    {
        // dd($request);
        $user = Auth()->user();
        $jurnal = Jurnal::get();
        if($user->verified==0) return view('adminlayouts/dummy');
        $myJurnal = $user->takenJurnalList();
        if($user->progress == 0)
          return $this->pretest();
        $now = substr($request->path(),7);
        $nowProgress = $myJurnal->pluck('name')->search($now);
        $index = ($user->progress>$nowProgress)?$nowProgress:$user->progress;
        $url = 'jurnal/'.$myJurnal[$index]->name;
        $text = file(public_path().$myJurnal[$index]->howto);
        // dd($text);
        return view($url)->with('user',$user)->with('myJurnal',$myJurnal)->with('jurnal',$jurnal)->with('howto_text',$text);
    }


    public function nextPage(Request $request)
    {
        $user = Auth()->user();
        if($user->verified==0) return redirect('adminlayouts/dummy');
        $callerJurnal = Jurnal::where('name', request('url'))->first();
        $myJurnal = $user->takenJurnalList();

        $this->incAction(request('accord1input'),request('accord2input'),request('accord3input'),$user, $callerJurnal);

        $currentProgress = $myJurnal->pluck('name')->search(request('url'));
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
        }
        else{
            // dd($myJurnal->count());
            $currentProgress = $currentProgress + 1;
            // dd($currentProgress);
            if($currentProgress >= $myJurnal->count()) return $this->posttest();
            $url = 'course/'.$myJurnal[$currentProgress]->name;
            $text = file(public_path().$myJurnal[$currentProgress]->howto);
        }
        // dd($url);
        return redirect($url)->with('user',$user)->with('myJurnal',$myJurnal)->with('howto_text',$text);
    }

    public function continue()
    {
        $user = Auth()->user();
        $myJurnal = $user->takenJurnalList();
        $url = 'course/'.$myJurnal[$user->progress-1]->name;
        $text = file(public_path().$myJurnal[$user->progress-1]->howto);
        return redirect($url)->with('user',$user)->with('myJurnal',$myJurnal)->with('howto_text',$text);
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
