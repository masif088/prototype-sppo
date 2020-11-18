<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(){

        return view('profile.index');
    }
    public function update(Request $request){
        User::find(Auth::id())->update(['password'=>Hash::make($request->password)]);
        return back();
    }
}
