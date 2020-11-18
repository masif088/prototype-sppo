<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ManagerCourseSchoolController extends Controller
{
    public function data()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return Datatables::of(Course::get())
            ->addColumn('edit_url', function ($row) {
                return route('admin.manager-course-school.edit', $row->id);
            })
            ->addColumn('show_url', function ($row) {
                return route('admin.manager-course-school.show', $row->id);
            })
            ->make(true);
    }
    public function index()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return view('admin.manager-course-school.index');
    }


    public function create()
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        return view('admin.manager-course-school.create');
    }

    public function store(Request $request)
    {
        Course::create($request->all());
        return redirect(route('admin.manager-course-school.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if (Auth::user()->role != 1) {
            abort(403);
        }
        $course=Course::findOrfail($id);
        return view('admin.manager-course-school.edit',['course'=>$course]);
    }


    public function update(Request $request, $id)
    {
        Course::find($id)->update($request->all());
        return redirect(route('admin.manager-course-school.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
