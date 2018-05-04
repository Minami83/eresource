<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
use Request;
use App\Jurnal;
use App\Log;
class CourseController extends Controller
{
    //

    private $progressRecord;

    public function __construct()
    {
        $this->middleware('auth');
        $this->progressRecord = collect([
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

    public function index(string $courseName, $howto=0, $video=0, $tutorial=0)
    {
        $user = Auth()->user();
        if($user->verified==0) return redirect('adminlayout/dummy');
        // $this->incAction($howto,$video,$tutorial,$user);
        if($user->progress < $this->progressRecord->get($courseName))
          return redirect('course/asce');
        $url = 'jurnal/'.$courseName;
        $myJurnal = $user->takenJurnalList();
        return view($url)->with('user',$user)->with('myJurnal',$myJurnal);
    }

    public function nextPage(Request $request)
    {
        $user = Auth()->user();
        if($user->verified==0) return redirect('adminlayout/dummy');
        $callerJurnal = Jurnal::where('name', request('url'))->first();
        // dd(request('url'));
        $this->incAction(request('accord1input'),request('accord2input'),request('accord3input'),$user, $callerJurnal);
        $currentProgress = $this->progressRecord->get(request('url'));
        if($user->progress == $currentProgress)
        {
            $user->progress = $user->progress + 1;
            $user->save();
            $url = 'course/'.$this->progressRecord->search($user->progress);
        }
        else $url = 'course/'.$this->progressRecord->search($currentProgress+1);
        $myJurnal = $user->takenJurnalList();
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
