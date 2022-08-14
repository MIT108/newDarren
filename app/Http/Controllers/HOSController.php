<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HOSController extends Controller
{
    //
    public function listHOS(){
        $HOSs = User::where('role_id', 3)
        ->where('id', '!=', 1)
        ->whereIn('status', array('inactive', 'active'))->get();
        return view('HOS/list')
        ->with('HOSs', $HOSs);
    }
}
