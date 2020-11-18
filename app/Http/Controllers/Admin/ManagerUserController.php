<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StudentInfo;
use App\TeacherInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class ManagerUserController extends Controller
{
    public function data()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return Datatables::of(User::get())
            ->addColumn('edit_url', function ($row) {
                return route('admin.manager-user.edit', $row->id);
            })
            ->addColumn('delete_url', function ($row) {
                return route('admin.manager-user.destroy', $row->id);
            })
            ->addColumn('show_url', function ($row) {
                return route('admin.manager-user.show', $row->id);
            })
            ->make(true);
    }

    public function index()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return view('admin.manager-user.index');
    }

    public function create()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return view('admin.manager-user.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data = User::create($data);
        if ($data->role == 3) {
            StudentInfo::create(['user_id' => $data->id]);
        } else if ($data->role == 2) {
            TeacherInfo::create(['user_id' => $data->id]);
        }
        return redirect(route('admin.manager-user.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $user = User::findOrFail($id);
        return view('admin.manager-user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($data['password'] != null) {
            $data['password'] = Hash::make($data['password']);
        }
        User::find($id)->update($data);
        return redirect(route('admin.manager-user.index'));
    }

    public function destroy($id)
    {
        //
    }
}
