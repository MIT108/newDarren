<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DAGController extends Controller
{
    //
    public function listDAG(){
        $DAGs = User::where('role_id', 2)
        ->where('id', '!=', 1)
        ->whereIn('status', array('inactive', 'active'))->get();
        return view('DAG/list')
        ->with('DAGs', $DAGs);
    }
}
