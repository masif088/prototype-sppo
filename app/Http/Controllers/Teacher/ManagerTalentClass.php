<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\IcAnswer;
use App\IcQuest;
use App\StudentTalent;
use App\TkdQuest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManagerTalentClass extends Controller
{
    public function data()
    {
        $student = StudentTalent::with('icAnswers')->get();
        return Datatables::of($student)
            ->addColumn('start_tkd', function ($row) {
                return route('teacher.manager-talent-class.exam-tkd-show', [$row->id, 1]);
            })
            ->addColumn('start_tkd2', function ($row) {
                return route('teacher.manager-talent-class.exam-tkd2-show', [$row->id, 6]);
            })
            ->addColumn('start_tkd3', function ($row) {
                return route('teacher.manager-talent-class.exam-tkd3-show', [$row->id, 11]);
            })
            ->addColumn('start_tkd4', function ($row) {
                return route('teacher.manager-talent-class.exam-tkd4-show', [$row->id, 17]);
            })
            ->addColumn('start_ci', function ($row) {
                return route('teacher.manager-talent-class.exam-ci-show', [$row->id, 1]);
            })
            ->make(true);
    }

    public function index()
    {
        return view('teacher.manager-talent-class.index');
    }

    public function create()
    {
        return view('teacher.manager-talent-class.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        StudentTalent::create($data);
        return redirect(route('teacher.manager-talent-class.index'));
    }

    public function showExamTkd($id, $number)
    {

        if (6 == $number) {
            StudentTalent::find($id)->update(['tkd' => $number]);
            return redirect(route('teacher.manager-talent-class.index'));
        }
        $tkd = TkdQuest::whereNumber($number)->get();
        $tkdid=array();
        foreach ($tkd as $t){
            array_push($tkdid,$t->id);
        }
        $random_keys=array_rand($tkdid,1);
        $quest = TkdQuest::findOrFail($tkdid[$random_keys]);
        return view('teacher.manager-talent-class.show-exam-tkd', ['id' => $id, 'number' => $number, 'quest' => $quest]);
    }

    public function storeExamTkd($id, $number)
    {
        StudentTalent::find($id)->update(['tkd' => $number]);
        return redirect(route('teacher.manager-talent-class.index'));
    }


    public function showExamTkd2($id, $number)
    {
        if (11 == $number) {
            StudentTalent::find($id)->update(['tkd_2' => $number-5]);
            return redirect(route('teacher.manager-talent-class.index'));
        }
        $tkd = TkdQuest::whereNumber($number)->get();
        $tkdid=array();
        foreach ($tkd as $t){
            array_push($tkdid,$t->id);
        }
        $random_keys=array_rand($tkdid,1);
        $quest = TkdQuest::findOrFail($tkdid[$random_keys]);
        return view('teacher.manager-talent-class.show-exam-tkd2', ['id' => $id, 'number' => $number, 'quest' => $quest]);
    }

    public function storeExamTkd2($id, $number)
    {
        StudentTalent::find($id)->update(['tkd_2' => $number-5]);
        return redirect(route('teacher.manager-talent-class.index'));
    }

    public function showExamTkd3($id, $number)
    {
        if (17 == $number) {
            StudentTalent::find($id)->update(['tkd_3' => $number-10]);
            return redirect(route('teacher.manager-talent-class.index'));
        }
        $tkd = TkdQuest::whereNumber($number)->get();
        $tkdid=array();
        foreach ($tkd as $t){
            array_push($tkdid,$t->id);
        }
        $random_keys=array_rand($tkdid,1);
        $quest = TkdQuest::findOrFail($tkdid[$random_keys]);
        return view('teacher.manager-talent-class.show-exam-tkd3', ['id' => $id, 'number' => $number, 'quest' => $quest]);
    }

    public function storeExamTkd3($id, $number)
    {
        StudentTalent::find($id)->update(['tkd_3' => $number-10]);
        return redirect(route('teacher.manager-talent-class.index'));
    }

    public function showExamTkd4($id, $number)
    {
        if (20 == $number) {
            StudentTalent::find($id)->update(['tkd_4' => $number-16]);
            return redirect(route('teacher.manager-talent-class.index'));
        }
        $tkd = TkdQuest::whereNumber($number)->get();
        $tkdid=array();
        foreach ($tkd as $t){
            array_push($tkdid,$t->id);
        }
        $random_keys=array_rand($tkdid,1);
        $quest = TkdQuest::findOrFail($tkdid[$random_keys]);
        return view('teacher.manager-talent-class.show-exam-tkd4', ['id' => $id, 'number' => $number, 'quest' => $quest]);
    }

    public function storeExamTkd4($id, $number)
    {
        StudentTalent::find($id)->update(['tkd_4' => $number-16]);
        return redirect(route('teacher.manager-talent-class.index'));
    }


    public function showExamCi($id, $number)
    {
        $quest = IcQuest::findOrFail($number);
        return view('teacher.manager-talent-class.show-exam-ci', ['id' => $id, 'number' => $number, 'quest' => $quest]);
    }

    public function storeExamCi(Request $request, $id, $number)
    {
        $quest = IcQuest::get();
        $data = $request->all();

        IcAnswer::create(['answer' => $data['answer'], 'student_id' => $id, 'ic_id' => $number]);
        if (count($quest) == $number) {
            return redirect(route('teacher.manager-talent-class.index'));
        }
        return redirect(route('teacher.manager-talent-class.exam-ci-show', [$id, $number + 1]));
    }

    public function createTkd()
    {
        return view('teacher.manager-talent-class.create-tkd');
    }

    public function storeTkd(Request $request)
    {
        $data = $request->all();
        TkdQuest::create($data);
        return redirect(route('manager-talent-class.index'));
    }

    public function createCi()
    {
        return view('teacher.manager-talent-class.create-ci');
    }

    public function storeCi(Request $request)
    {
        $data = $request->all();
//        dd($data);
        IcQuest::create($data);
        return redirect(route('teacher.manager-talent-class.create-ci'));
    }
}
