<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()==null){
            return redirect(route('login'));
        }else{
            if (Auth::user()->role==1){
                return redirect((route('admin.dashboard')));
            }
            if (Auth::user()->role==2){
                return redirect((route('teacher.dashboard')));
            }
            if (Auth::user()->role==3){
                return redirect((route('student.dashboard')));
            }
        }
    }
}
