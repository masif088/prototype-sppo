<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\ManagerClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 2) {
            abort(403);
        }
//        $class=ManagerClass::whereHas('classCourses',function ($q){
//            $q->whereHas('teacherClassCourses',function ($q){
//                $q->whereUserId(Auth::id());
//            });
//        })
//            ->with('classCourses','classCourses.teacherClassCourses')
//            ->get();
        return view('teacher.dashboard.index');
    }
}
