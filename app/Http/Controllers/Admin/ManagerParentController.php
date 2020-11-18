<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersParentImport;
use App\ManagerClass;
use App\ParentInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ManagerParentController extends Controller
{
    public function data()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $user = User::whereRole(4)
            ->get();
        return Datatables::of($user)
            ->addColumn('edit_url', function ($row) {
                return route('admin.manager-parent.edit', $row->id);
            })
            ->addColumn('show_url', function ($row) {
                return route('admin.manager-parent.show', $row->id);
            })
            ->make(true);
    }

    public function index()
    {
        return view('admin.manager-parent.index');
    }

    public function create()
    {
        $classes=ManagerClass::whereStatus(1)->get();
        return view('admin.manager-parent.create',['classes'=>$classes]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 4;
        $data = User::create($data);
        return redirect(route('admin.manager-parent.index'));
    }

    public function show($id)
    {
        $user=User::whereRole(3)->findOrFail($id);
        return view('admin.manager-parent.show',['user'=>$user]);
    }

    public function edit($id)
    {
        $user=User::whereRole(3)->findOrFail($id);
        $classes=ManagerClass::whereStatus(1)->get();
        return view('admin.manager-parent.edit',['classes'=>$classes,'user'=>$user]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($data['password'] != null) {
            $data['password'] = Hash::make($data['password']);
        }
        User::find($id)->update($data);
        return redirect(route('admin.manager-parent.index'));
    }

    public function updateInfoParent(Request $request, $id){
        $data = $request->all();
        ParentInfo::whereUserId($id)->update($data);
        return redirect(route('admin.manager-parent.show',$id));
    }

    public function destroy($id)
    {
        //
    }

    public function downloadTemplateExcel(){
        return response()->download(public_path("/assets/main/user-template.csv" ));
    }
    public function importParent(Request $request){
        Excel::import(new UsersParentImport(),request()->file('file'));
        return back();
    }
}
