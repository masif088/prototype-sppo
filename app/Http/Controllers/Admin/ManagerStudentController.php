<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersStudentImport;
use App\ManagerClass;
use App\StudentInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ManagerStudentController extends Controller
{
    public function data()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $user = User::whereRole(3)
            ->with('studentInfos', 'studentInfos.managerClass')
            ->get();
        return Datatables::of($user)
            ->addColumn('edit_url', function ($row) {
                return route('admin.manager-student.edit', $row->id);
            })
            ->addColumn('show_url', function ($row) {
                return route('admin.manager-student.show', $row->id);
            })
            ->make(true);
    }

    public function index()
    {
        return view('admin.manager-student.index');
    }

    public function create()
    {
        $classes=ManagerClass::whereStatus(1)->get();
        return view('admin.manager-student.create',['classes'=>$classes]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 3;
        $data = User::create($data);
        StudentInfo::create(['user_id' => $data->id,'class_id'=>$request->class_id]);
        return redirect(route('admin.manager-student.index'));
    }

    public function show($id)
    {
        $user=User::whereRole(3)->findOrFail($id);

        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = $user->studentInfos[0]->birth_date;
        $age="";
        if ($birthDate!=null){
//            $birthDate = "1984-05-21";

            $birthDate = explode("-", $birthDate);

            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));


        }

        return view('admin.manager-student.show',['user'=>$user,'age'=>$age]);
    }

    public function edit($id)
    {
        $user=User::whereRole(3)->findOrFail($id);
        $classes=ManagerClass::whereStatus(1)->get();
        return view('admin.manager-student.edit',['classes'=>$classes,'user'=>$user]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($data['password'] != null) {
            $data['password'] = Hash::make($data['password']);
        }
        User::find($id)->update($data);
        return redirect(route('admin.manager-student.index'));
    }

    public function updateInfoStudent(Request $request, $id){
        $data = $request->all();
        User::find($id)->update(['name'=>$request->name]);
        unset($data['_token']);
        unset($data['name']);
        unset($data['add']);
        StudentInfo::whereUserId($id)->update($data);
        return redirect(route('admin.manager-student.show',$id));
    }

    public function destroy($id)
    {
        //
    }

    public function downloadTemplateExcel(){
        return response()->download(public_path("/assets/main/user-template.csv" ));
    }
    public function importStudent(Request $request){
        Excel::import(new UsersStudentImport(),request()->file('file'));
        return back();
    }
}
