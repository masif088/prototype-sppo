<?php

namespace App\Http\Controllers\Admin;

use App\ClassCourse;
use App\Course;
use App\Http\Controllers\Controller;
use App\ManagerClass;
use App\StudentInfo;
use App\TeacherClassCourse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use function GuzzleHttp\Promise\all;

class ManagerClassController extends Controller
{
    public function data()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return Datatables::of(ManagerClass::with('user')->get())
            ->addColumn('edit_url', function ($row) {
                return route('admin.manager-class.edit', $row->id);
            })
            ->addColumn('show_student_url', function ($row) {
                return route('admin.manager-class.show-student', $row->title);
            })
            ->addColumn('show_course_url', function ($row) {
                return route('admin.manager-class.show-course', $row->title);
            })
            ->make(true);
    }

    public function dataStudent($title)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $user = User::whereHas('studentInfos', function ($q) use ($title) {
            $q->whereHas('managerClass', function ($q) use ($title) {
                $q->where('title', '=', $title);
            });
        })
            ->with('studentInfos', 'studentInfos.managerClass')
            ->get();
        return Datatables::of($user)
            ->addColumn('delete_url', function ($row) use ($title) {
                return route('admin.manager-class.destroy-student', [$title, $row->id]);
            })
            ->make(true);
    }

    public function dataNotStudent($title)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $user = User::whereHas('studentInfos', function ($q) use ($title) {
            $q->whereHas('managerClass', function ($q) use ($title) {
                $q->where('title', '!=', $title);
            });
        })
            ->with('studentInfos', 'studentInfos.managerClass')
            ->get();
        return Datatables::of($user)
            ->addColumn('add_url', function ($row) use ($title) {
                return route('admin.manager-class.store-student', [$title, $row->id]);
            })
            ->make(true);
    }

    public function dataCourse($title)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $course = ClassCourse::whereHas('managerClass',function ($q) use ($title) {
            $q->whereTitle($title);
        })
            ->with('managerClass','course')
            ->get();
        return Datatables::of($course)
            ->addColumn('show_url', function ($row) use ($title) {
                return route('admin.manager-class.edit-teacher', [$title, $row->course->title,$row->id]);
            })
            ->make(true);
    }

    public function dataNotCourse($title){
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $course = Course::whereDoesntHave('classCourses',function ($q) use ($title) {
            $q->whereHas('managerClass',function ($q) use ($title) {
               $q->whereTitle($title);
            });
        })
            ->get();
        return Datatables::of($course)
            ->addColumn('add_course_url', function ($row) use ($title) {
                return route('admin.manager-class.store-course', [$title, $row->id]);
            })
            ->make(true);
    }

    public function index()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return view('admin.manager-class.index');
    }

    public function create()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $teachers = User::whereRole(2)->get();
        return view('admin.manager-class.create', ['teachers' => $teachers]);
    }

    public function store(Request $request)
    {
        ManagerClass::create($request->all());
        return redirect(route('admin.manager-class.index'));
    }

    public function storeStudent($title, $id)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $classes = ManagerClass::whereTitle($title)->firstOrFail();
        StudentInfo::whereUserId($id)->update(['class_id' => $classes->id]);
        return redirect(route('admin.manager-class.create-student', $title));
    }

    public function storeCourse($title,$id){
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $classes = ManagerClass::whereTitle($title)->firstOrFail();
        ClassCourse::create(['class_id'=>$classes->id,'course_id'=>$id]);
        return redirect(route('admin.manager-class.create-course', $title));
    }

    public function destroyStudent($title, $id)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        StudentInfo::whereUserId($id)->update(['class_id' => 0]);
        return redirect(route('admin.manager-class.show', $title));
    }


    public function show($title)
    {

    }

    public function showStudent($title)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return view('admin.manager-class.manager-student.index', ['title' => $title]);
    }

    public function showCourse($title)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return view('admin.manager-class.manager-course.index', ['title' => $title]);
    }

    public function editTeacher($title,$course,$id)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $teachers=TeacherClassCourse::whereHas('classCourse',function ($q) use ($title, $course) {
            $q->whereHas('course',function ($q) use ($course) {
                $q->whereTitle($course);
            })->whereHas('managerClass',function ($q) use ($title){
                $q->whereTitle($title);
            });
        })->get();
        $users=User::whereRole(2)->get();
        return view('admin.manager-class.manager-course.edit', ['title' => $title,'course'=>$course,'id'=>$id,'teachers'=>$teachers,'users'=>$users]);
    }
    public function updateTeacher(Request $request,$title,$course,$id){
        TeacherClassCourse::whereClassCourseId($id)->delete();
        foreach ($request->input('user_id') as $user_id){
            TeacherClassCourse::create(['user_id'=>$user_id,'class_course_id'=>$id]);
        }
        return redirect(route('admin.manager-class.show-course',$title));
    }

    public function createStudent($title)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return view('admin.manager-class.manager-student.create', ['title' => $title]);
    }

    public function createCourse($title)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return view('admin.manager-class.manager-course.create', ['title' => $title]);
    }


    public function edit($id)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $teachers = User::whereRole(2)->get();
        $class = ManagerClass::findOrFail($id);
        return view('admin.manager-class.edit', ['teachers' => $teachers, 'class' => $class]);
    }

    public function update(Request $request, $id)
    {
        $data=$request->all();
        if ($request->status==1){
            ManagerClass::find($id)->update($data);
        }else{
            $data['title']="backup - ".$data['title'];
            ManagerClass::find($id)->update($data);

        }
        return redirect(route('admin.manager-class.index'));
    }

    public function destroy($id)
    {
        //
    }
}
