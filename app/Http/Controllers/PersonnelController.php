<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    //
    public function listPersonnel(){
        $personnels = User::where('role_id', 4)
        ->where('id', '!=', 1)
        ->whereIn('status', array('inactive', 'active'))->get();
        return view('personnel/list')
        ->with('personnels', $personnels);
    }
}
