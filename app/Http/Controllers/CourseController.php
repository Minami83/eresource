<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
use Request;
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
        'nature' => 19]);
    }

    public function pretest()
    {
        $user = Auth()->user();
        $pretest_quest = Pretest::get();
        // dd($pretest_quest);
        return view('webpage/pretest')->with('user',$user)->with('pretest',$pretest_quest);
    }

    public function preAns(Request $request)
    {
        $user = Auth()->user();
        $ans = $request->all();
        $pretest_quest = Pretest::get();
        foreach($pretest_quest as $quest){
            $user->pretests()->attach($pretest, ['answer' => $ans[$quest->id] ]);
        }
        $myJurnal = $user->takenJurnalList();
        $url = 'jurnal'.$myJurnal[0]->name;
        return view($url)->with('user',$user)->with('myJurnal', $myJurnal);
    }

    public function posttest()
    {
        $user = Auth()->user();
        $posttest_quest = Posttest::get();
        return view('webpage/posttest')->with('user',$user)->with('posttest',$posttest_quest);
    }

    public function postAns(Request $request)
    {
        $user = Auth()->user();
        $ans = $request->all();
        $posttest_quest = Posttest::get();
        foreach($posttest_quest as $quest){
            $user->posttests()->attach($posttest, ['answer' => $ans[$quest->id] ]);
        }
        $myJurnal = $user->takenJurnalList();
        $url = 'jurnal'.$myJurnal[0]->name;
        return view($url)->with('user',$user)->with('myJurnal', $myJurnal);
    }

    public function index(string $courseName, $howto=0, $video=0, $tutorial=0)
    {
        $user = Auth()->user();
        if($user->verified==0) return view('adminlayouts/dummy');
        $myJurnal = $user->takenJurnalList();
        if($user->progress == 0)
          return $this->pretest();
        $now = substr(Request::path(),7);
        $nowProgress = $myJurnal->pluck('name')->search($now);
        $url = 'jurnal/'.$myJurnal[($user->progress>$nowProgress)?$nowProgress:$user->progress]->name;
        return view($url)->with('user',$user)->with('myJurnal',$myJurnal);
    }


    public function nextPage(Request $request)
    {
        $user = Auth()->user();
        if($user->verified==0) return redirect('adminlayout/dummy');
        $callerJurnal = Jurnal::where('name', request('url'))->first();
        $myJurnal = $user->takenJurnalList();

        $this->incAction(request('accord1input'),request('accord2input'),request('accord3input'),$user, $callerJurnal);

        $currentProgress = $myJurnal->pluck('name')->search(request('url'));
        if($user->progress-1 == $currentProgress)
        {
            $user->progress = $user->progress + 1;
            if($user->progress > $myJurnal->count()){
                $user->progress = $user->progress - 1;
                $user->save();
                return $this->posttest();
            }
            $user->save();

            $url = 'course/'.$myJurnal[$user->progress]->name;
        }
        else{
            $currentProgress = $currentProgress + 1;
            if($currentProgress > $myJurnal->count()) return $this->posttest();
            $url = 'course/'.$myJurnal[$currentProgress]->name;

        }
        // dd($url);
        return redirect($url)->with('user',$user)->with('myJurnal',$myJurnal);
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
