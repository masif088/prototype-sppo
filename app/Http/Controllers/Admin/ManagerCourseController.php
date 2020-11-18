<?php

namespace App\Http\Controllers\Admin;

use App\ClassCourse;
use App\Http\Controllers\Controller;
use App\TeacherClassCourse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ManagerCourseController extends Controller
{
    public function data($title)
    {

        $user = DB::table('class_courses')
            ->join('classes', 'classes.id', '=', 'class_courses.class_id')
            ->join('courses', 'courses.id', '=', 'class_courses.course_id')
            ->where('classes.title', '=', $title)
            ->get();
        return Datatables::of($user)
//            ->addColumn('edit_url', function ($row) use ($title) {
//                return route('admin.manager-course.edit',[$title, $row->id]);
//            })
            ->addColumn('delete_url', function ($row) use ($title) {
                return route('admin.manager-course.destroy', [$title, $row->id]);
            })
            ->addColumn('show_url', function ($row) use ($title) {
                return route('admin.manager-course.show', [$title, $row->id]);
            })
            ->make(true);
    }


    public function dataCourse($title, $course)
    {
        $user = TeacherClassCourse::with('user', 'classCourse')
            ->join('class_courses', 'teacher_class_courses.class_course_id', '=', 'class_courses.id')
            ->join('classes', 'classes.id', '=', 'class_courses.class_id')
            ->join('users', 'users.id', '=', 'teacher_class_courses.user_id')
            ->where('classes.title', '=', $title)
            ->where('teacher_class_courses.class_course_id', '=', $course)
            ->get();
        return Datatables::of($user)
            ->addColumn('delete_url', function ($row) use ($title) {
                return route('admin.manager-course.destroy', [$title, $row->id]);
            })
            ->addColumn('show_url', function ($row) use ($title) {
                return route('admin.manager-course.show', [$title, $row->id]);
            })
            ->make(true);
    }


    public function index($title)
    {
        return view('head-class.manager-course.index', ['title' => $title]);
    }

    public function show($title, $id)
    {
        $courses = ClassCourse::whereCourseId($id)->firstOrFail();
        return view('head-class.manager-course.show',
            [
                'title' => $title,
                'id' => $id,
                'courses' => $courses
            ]
        );
    }

}
