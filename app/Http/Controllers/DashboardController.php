<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        $users = User::where('id', '!=', Auth::user()->id)->with(['role'])->get();

        return view('dashboard.index')
        ->with('users', $users);
    }
}
