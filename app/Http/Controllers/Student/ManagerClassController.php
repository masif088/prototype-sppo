<?php

namespace App\Http\Controllers\Student;

use App\ClassCourse;
use App\Course;
use App\Http\Controllers\Controller;
use App\ManagerClass;
use App\Mission;
use App\MissionDetail;
use App\MissionSubmit;
use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerClassController extends Controller
{
    public function index($course){
//        $class = ManagerClass::whereTitle($title)->firstOrFail();
        $courses = Course::whereTitle($course)->firstOrFail();
        $classCourse = ClassCourse::whereClassId(Auth::user()->studentInfos[0]->class_id)->whereCourseId($courses->id)->firstOrFail();
        $modules=Module::whereHas('classModules', function ($q) use ($classCourse) {
           $q->whereClassCourseId($classCourse->id);
        })->take(6)->get();
        $missions=Mission::whereClassCourseId($classCourse->id)->take(6)->get();
        return view('student.manager-class.index',['title'=>$course,'modules'=>$modules,'missions'=>$missions]);
    }
    public function showDetailModule($course, $id){
        $modules=Module::findOrFail($id);
        return view('student.manager-class.show-module',['title'=>$course,'modules'=>$modules]);
    }
    public function showMission($course,$id){
        $mission=MissionSubmit::whereHas('missionDetail',function ($q) use ($id) {
            $q->whereMissionId($id);
        })->whereUserId(Auth::id())->whereNumber(1)->get();
        if (count($mission)){
            return redirect(route('student.manager-class.show-detail-mission',[$course,$id,1]));
        }
        $mission=Mission::findOrFail($id);
        return view('student.manager-class.show-mission',['title'=>$course,'id'=>$id,'mission'=>$mission]);
    }

    public function startMission($course,$id){
        $count=MissionDetail::whereMissionId($id)->get();
        $numbers = range(1, count($count));
        shuffle($numbers);
        for ($i = 0; $i < count($count); $i++) {
            $answer = array(
                'mission_detail_id' => $count[$i]->id,
                'user_id' => Auth::id(),
                'number' => $numbers[$i],
            );
            MissionSubmit::create($answer);
        }
        return redirect(route('student.manager-class.show-detail-mission',[$course,$id,1]));


    }

    public function showDetailMission($course,$id,$no){
        $mission=MissionSubmit::whereHas('missionDetail',function ($q) use ($id) {
            $q->whereMissionId($id);
        })->whereUserId(Auth::id())->whereNumber($no)->firstOrFail();
        $allMission=MissionSubmit::whereHas('missionDetail',function ($q) use ($id) {
            $q->whereMissionId($id);
        })->whereUserId(Auth::id())->orderBy('number')->get();

        return view('student.manager-class.show-detail-mission',['title'=>$course,'id'=>$id,'mission'=>$mission,'allMission'=>$allMission]);
    }
    public function storeDetailMission(Request $request,$course,$id,$number){
//        dd($request->all());
        $data=$request->all();
        unset($data['_token']);
        $mission=MissionSubmit::whereHas('missionDetail',function ($q) use ($id) {
            $q->whereMissionId($id);
        })->whereUserId(Auth::id())->whereNumber($number)->update($data);

        if (count(MissionDetail::whereMissionId($id)->get())==$number){
            return redirect(route('student.manager-class',$course));
        }
        return redirect(route('student.manager-class.show-detail-mission',[$course,$id,$number+1]));

    }
}
