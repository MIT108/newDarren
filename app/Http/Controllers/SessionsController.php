<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            return redirect('home')->with('success','You are logged in.');
        }
        else{

            return back()->with('error','Email or password invalid.');
        }
    }

    public function destroy()
    {

        Auth::logout();

        return redirect('/')->with('success','You\'ve been logged out.');
    }
}
