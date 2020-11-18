<?php

namespace App\Http\Controllers\Teacher;

use App\ClassCourse;
use App\ClassModule;
use App\Course;
use App\Http\Controllers\Controller;
use App\ManagerClass;
use App\Mission;
use App\MissionDetail;
use App\MissionScore;
use App\MissionSubmit;
use App\Module;
use App\StudentInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ManagerClassController extends Controller
{
    public function data()
    {
        if (Auth::user()->role != 2) {
            abort(403);
        }
//        $module=Clas::get();
    }

    public function dataModule($title, $course)
    {
        $class = ManagerClass::whereTitle($title)->firstOrFail();
        $courses = Course::whereTitle($course)->firstOrFail();
        $classCourse = ClassCourse::whereClassId($class->id)->whereCourseId($courses->id)->firstOrFail();
        $module = Module::whereHas('classModules', function ($q) use ($classCourse) {
            $q->whereClassCourseId($classCourse->id);
        })
            ->with('user')
            ->get();
        return Datatables::of($module)
            ->addColumn('edit_url', function ($row) use ($title, $course) {
                return route('teacher.manager-class.edit-module', [$title, $course, $row->id]);
            })
            ->addColumn('delete_url', function ($row) use ($title, $course) {
                return route('teacher.manager-class.destroy-module', [$title, $course, $row->id]);
            })

            ->make(true);
    }
    public function dataNotModule($title,$course){
        $class = ManagerClass::whereTitle($title)->firstOrFail();
        $courses = Course::whereTitle($course)->firstOrFail();
        $classCourse = ClassCourse::whereClassId($class->id)->whereCourseId($courses->id)->firstOrFail();
        $module = Module::whereDoesntHave('classModules', function ($q) use ($classCourse) {
            $q->whereClassCourseId($classCourse->id);
        })
            ->with('user')
            ->get();
        return Datatables::of($module)
            ->addColumn('add_url', function ($row) use ($classCourse, $title, $course) {
                return route('teacher.manager-class.add-module', [$title, $course,$row->id]);
            })
            ->make(true);
    }
    public function addModule($title,$course,$id){
        $class = ManagerClass::whereTitle($title)->firstOrFail();
        $courses = Course::whereTitle($course)->firstOrFail();
        $classCourse = ClassCourse::whereClassId($class->id)->whereCourseId($courses->id)->firstOrFail();
        ClassModule::create(['class_course_id' => $classCourse->id, 'module_id' => $id]);
        return redirect(route('teacher.manager-class.index', ['title' => $title, 'course' => $course]));
    }

    public function dataMissionDetail($title, $course, $id)
    {
        return DataTables::of(MissionDetail::whereMissionId($id)->get())
            ->addColumn('edit_url', function ($row) use ($title, $course) {
                return route('teacher.manager-class.edit-mission-detail', [$title, $course,$row->mission_id, $row->id]);
            })
            ->addColumn('delete_url', function ($row) use ($title, $course) {
                return route('teacher.manager-class.destroy-mission-detail', [$title, $course,$row->mission_id, $row->id]);
            })
            ->make(true);
    }

    public function dataMissionScore($title, $course, $id)
    {
        $class = ManagerClass::whereTitle($title)->firstOrFail();
        return DataTables::of(StudentInfo::whereClassId($class->id)->with('user')->get())
            ->addColumn('value_progress',function ($row) use ($class, $id) {
                $userid=$row->user->id;
                $a=count(MissionDetail::whereMissionId($id)->whereHas('missionSubmits',function ($q) use ($userid) {
                        $q-> whereUserId($userid);
                    })->get())/count(MissionDetail::whereMissionId($id)->get())*100;
                $a=(string)$a."%";
            return $a;
            })
            ->addColumn('score_url', function ($row) use ($id, $course, $title) {
                $userid=$row->user->id;
                return route('teacher.manager-class.show-mission-score',[$title, $course,$id,$userid]);
            })
            ->addColumn('score',function ($row) use ($id) {
                $userid=$row->user->id;
                $score=MissionScore::whereUserId($userid)->whereMissionId($id)->first();
                if ($score){
                    return $score->score;
                }else{
                    return 0;
                }

            })
            ->make(true);
    }
    public function showMissionScore($title, $course,$id,$userid){
        $mission=MissionDetail::whereMissionId($id)->with(['missionSubmits'=>function ($q) use ($userid) {
               $q->whereUserId($userid);
        }])->get();
//        dd($mission);
        for ($k=0;$k<count($mission)-1;$k++) {
            for ($i = 0; $i < count($mission)-1 - $k; $i++) {
                if ($mission[$i]['type'] > $mission[$i + 1]['type']) {
                    $temp = $mission[$i + 1];
                    $mission[$i + 1] = $mission[$i];
                    $mission[$i] = $temp;
                }
            }
        }

        $missions=Mission::findOrFail($id);
        $pg=0;
        $pgr=0;
        $count=count($mission);
        $user=User::findOrFail($userid);
        return view('teacher.manager-class.manager-mission.manager-mission-score.show',['title'=>$title, 'course'=>$course,'id'=>$id,'userid'=>$userid,'mission'=>$mission,'pg'=>$pg,'pgr'=>$pgr,'count'=>$count,'missions'=>$missions,'user'=>$user]);
    }
    public function storeMissionScore(Request $request,$title, $course,$id,$userid){

        $ms=MissionScore::updateOrCreate(['user_id'=>$userid,'mission_id'=>$id],['score'=>$request->score]);
        return redirect(route('teacher.manager-class.index-mission-score',[$title, $course,$id]));
    }

    public function dataMission($title, $course)
    {
        $class = ManagerClass::whereTitle($title)->firstOrFail();
        $courses = Course::whereTitle($course)->firstOrFail();
        $classCourse = ClassCourse::whereClassId($class->id)->whereCourseId($courses->id)->firstOrFail();
        $mission = Mission::whereClassCourseId($classCourse->id)
            ->get();
        return Datatables::of($mission)
            ->addColumn('edit_url', function ($row) use ($title, $course) {
                return route('teacher.manager-class.edit-mission', [$title, $course, $row->id]);
            })
            ->addColumn('delete_url', function ($row) use ($title, $course) {
                return route('teacher.manager-class.destroy-mission', [$title, $course, $row->id]);
            })
            ->addColumn('show_url', function ($row) use ($title, $course) {
                return route('teacher.manager-class.show-mission', [$title, $course, $row->id]);
            })
            ->addColumn('score_url', function ($row) use ($title, $course) {
                return route('teacher.manager-class.index-mission-score', [$title, $course, $row->id]);
            })
            ->make(true);
    }

    public function index($title, $course)
    {
        if (Auth::user()->role != 2) {
            abort(403);
        }
        $class = ManagerClass::whereHas('classCourses', function ($q) {
            $q->whereHas('teacherClassCourses', function ($q) {
                $q->whereUserId(Auth::id());
            });
        })
            ->get();

        return view('teacher.manager-class.index', ['classes' => $class, 'title' => $title, 'course' => $course]);
    }

    public function indexMissionScore($title,$course,$id){
        $mission=Mission::findOrFail($id);
        return view('teacher.manager-class.manager-mission.manager-mission-score.index',['title' => $title, 'course' => $course, 'id' => $id,'mission'=>$mission]);
    }

    public function create()
    {
        //
    }

    public function showMission($title, $course, $id)
    {
        $mission = Mission::findOrfail($id);
        return view('teacher.manager-class.manager-mission.show', ['title' => $title, 'course' => $course, 'id' => $id, 'mission' => $mission]);
    }

    public function createMission($title, $course)
    {
        if (Auth::user()->role != 2) {
            abort(403);
        }
        return view('teacher.manager-class.manager-mission.create', ['title' => $title, 'course' => $course]);
    }

    public function createMissionDetail($title, $course, $id)
    {
        if (Auth::user()->role != 2) {
            abort(403);
        }
        $mission = Mission::findOrfail($id);
        return view('teacher.manager-class.manager-mission.manager-mission-detail.create', ['title' => $title, 'course' => $course, 'id' => $id,'mission'=>$mission]);
    }

    public function storeMission(Request $request, $title, $course)
    {
        $data = $request->all();
        $class = ManagerClass::whereTitle($title)->firstOrFail();
        $courses = Course::whereTitle($course)->firstOrFail();
        $classCourse = ClassCourse::whereClassId($class->id)->whereCourseId($courses->id)->firstOrFail();
        $data['class_course_id'] = $classCourse->id;
        Mission::create($data);
        return redirect(route('teacher.manager-class.index', ['title' => $title, 'course' => $course]));
    }

    public function storeMissionDetail(Request $request, $title, $course, $id)
    {
        $data = $request->all();
        $data['mission_id'] = $id;
        MissionDetail::create($data);
        return redirect(route('teacher.manager-class.show-mission', ['title' => $title, 'course' => $course, 'id' => $id]));
    }

    public function editMissionDetail($title, $course, $id,$idDetail)
    {
        $missionDetail=MissionDetail::findOrFail($idDetail);
        $mission=Mission::findOrFail($id);
        return view('teacher.manager-class.manager-mission.manager-mission-detail.edit',['title' => $title, 'course' => $course, 'id' => $id,'missionDetail'=>$missionDetail,'mission'=>$mission]);
    }
    public function updateMissionDetail(Request $request,$title, $course, $id,$idDetail)
    {
        $data=$request->all();
        MissionDetail::find($idDetail)->update($data);
        return redirect(route('teacher.manager-class.show-mission', ['title' => $title, 'course' => $course, 'id' => $id]));
    }

    public function editMission($title, $course, $id)
    {
        if (Auth::user()->role != 2) {
            abort(403);
        }
        $mission = Mission::findOrFail($id);
        return view('teacher.manager-class.manager-mission.edit', ['title' => $title, 'course' => $course, 'mission' => $mission]);
    }

    public function updateMission(Request $request, $title, $course, $id)
    {
        Mission::find($id)->update($request->all());
        return redirect(route('teacher.manager-class.index', ['title' => $title, 'course' => $course]));
    }

    public function destroyMission($title, $course, $id)
    {
        MissionSubmit::whereHas('missionDetail', function ($q) use ($id) {
            $q->whereMissionId($id);
        })->delete();
        MissionDetail::whereMissionId($id)->delete();
        Mission::find($id)->delete();
        return redirect(route('teacher.manager-class.index', ['title' => $title, 'course' => $course]));
    }

    public function createModule($title, $course)
    {
        if (Auth::user()->role != 2) {
            abort(403);
        }
        return view('teacher.manager-class.manager-module.create', ['title' => $title, 'course' => $course]);
    }

    public function editModule($title, $course, $id)
    {
        $module = Module::findOrFail($id);
        if (Auth::user()->role != 2 or $module->user_id != Auth::id()) {
            abort(403);
        }
        return view('teacher.manager-class.manager-module.edit', ['title' => $title, 'course' => $course, 'module' => $module]);
    }

    public function destroyModule($title, $course, $id)
    {
        ClassModule::whereModuleId($id)->delete();
        return redirect(route('teacher.manager-class.index', ['title' => $title, 'course' => $course]));

    }

    public function storeModule(Request $request, $title, $course)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['watermark'] = env('APP_NAME') . ' - ' . Auth::user()->name;
        $module = Module::create($data);
        $class = ManagerClass::whereTitle($title)->firstOrFail();
        $courses = Course::whereTitle($course)->firstOrFail();
        $classCourse = ClassCourse::whereClassId($class->id)->whereCourseId($courses->id)->firstOrFail();
        ClassModule::create(['class_course_id' => $classCourse->id, 'module_id' => $module->id]);
        return redirect(route('teacher.manager-class.index', ['title' => $title, 'course' => $course]));
    }

    public function updateModule(Request $request, $title, $course, $id)
    {
        $data = $request->all();
        Module::find($id)->update($data);
        return redirect(route('teacher.manager-class.index', ['title' => $title, 'course' => $course]));
    }
    public function showModule($title,$course){
        return view('teacher.manager-class.manager-module.show', ['title' => $title, 'course' => $course]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function a(){

    }
    public function dataScoreClassCourse($title, $course){
        $class = ManagerClass::whereTitle($title)->firstOrFail();
        $courses = Course::whereTitle($course)->firstOrFail();
        $classCourse = ClassCourse::whereClassId($class->id)->whereCourseId($courses->id)->firstOrFail();

        $student=User::whereRole(3)->whereHas('studentInfos',function($q) use ($class) {
            $q->where('class_id','=',$class->id);
        })->get();

        $score=MissionScore::whereHas('mission',function($q) use ($classCourse) {
            $q->whereClassCourseId($classCourse->id);
        })->orderBy('mission_id')->get();
//        dd($score);

        $a=array();
        for ($i=0;$i<count($student);$i++){
            $a[$i]['name']=$student[$i]['name'];
            $a[$i]['id']=$student[$i]['id'];
            for ($j=0;$j<count($score);$j++){
                if ($score[$j]['user_id']==$a[$i]['id']) {
                    $a[$i][$score[$j]['mission_id']] =$score[$j]['score'];
                }
            }
        }
        return DataTables::of($a)->make(true);
    }
    public function showScore($title,$course){
        $class = ManagerClass::whereTitle($title)->firstOrFail();
        $courses = Course::whereTitle($course)->firstOrFail();
        $classCourse = ClassCourse::whereClassId($class->id)->whereCourseId($courses->id)->firstOrFail();

        $mission=Mission::whereClassCourseId($classCourse->id)->get();
        return view('teacher.manager-class.show',['title'=>$title,'course'=>$course,'mission'=>$mission]);
    }
}
