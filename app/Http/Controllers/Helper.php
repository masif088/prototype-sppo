<?php


namespace App\Http\Controllers;

use App\ClassCourse;
use App\ManagerClass;
use App\Mission;
use App\MissionSubmit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;

class Helper extends Facade
{

    protected static function getFacadeAccessor() {
        //what you want
        return 'getPhotographer';
    }

    public static function getPhotographer() {
        return "photographer";
    }

    public static function getTeacherClass(){
        $class=ManagerClass::whereHas('classCourses',function ($q){
            $q->whereHas('teacherClassCourses',function ($q){
                $q->whereUserId(Auth::id());
            });
        })
            ->with('classCourses','classCourses.teacherClassCourses')
            ->get();
        return $class;
    }
    public static function getStudentClass(){
//        dd(Auth::user()->studentInfos[0]->class_id);
        $class=ClassCourse::whereClassId(Auth::user()->studentInfos[0]->class_id)->get();

        return $class;
    }
    public static function getMissionProgress($id){
        $prog=Mission::find($id);
        $c=count(Mission::find($id)->missionDetails);

        $count=0;
        foreach ($prog->missionDetails as $p){
            foreach ($p->missionSubmits as $q){
                if ($q['user_id']==Auth::id() && $q['answer']!=null){
                    $count++;
                }
            }
        }
//        }
        return $count/$c *100;
    }
}
