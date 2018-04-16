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

    public function index(Request $request)
    {
        $url = Request::path();
        $user = Auth()->user();
        if($user->progress < $this->progressRecord->get(substr($url,7)))
          return redirect('course/asce');
        $url = 'jurnal/'.substr($url,7);
        return view($url)->with('user',$user);
    }
}
