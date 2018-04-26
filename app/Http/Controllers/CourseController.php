<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
use Request;
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
        $this->incAction($howto,$video,$tutorial,$user);
        if($user->progress < $this->progressRecord->get($courseName))
          return redirect('course/asce');
        $url = 'jurnal/'.$courseName;
        return view($url)->with('user',$user);
    }

    public function nextPage(Request $request, $courseName)
    {
        $user = Auth()->user();
        dd($request);
        // $this->incAction($howto,$video,$tutorial,$user);
        $currentProgress = $this->progressRecord->get($courseName);
        if($user->progress == $currentProgress)
        {
            $user->progress = $user->progress + 1;
            $user->save();
            $url = 'course/'.$this->progressRecord->search($user->progress);
        }
        else $url = 'course/'.$this->progressRecord->search($currentProgress+1);
        return redirect($url)->with('user',$user);
    }

    public function incAction( $howto,  $video,  $tutorial, $user)
    {

        if($howto!=0 or $video!=0 or $tutorial!=0)
        {
            $user->how_to = $user->how_to + $howto;
            $user->video = $user->video + $video;
            $user->tutorial = $user->tutorial + $tutorial;
            $user->save();
        }
    }
}
