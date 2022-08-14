<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //

    public function listAdmin(){
        $admins = User::where('role_id', 1)
        ->where('id', '!=', 1)
        ->whereIn('status', array('inactive', 'active'))->get();
        return view('admin/list')
        ->with('admins', $admins);
    }
}
