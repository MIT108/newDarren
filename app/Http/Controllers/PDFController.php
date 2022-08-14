<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class PDFController extends Controller
{
    //
    public function getAllUsers($task_id, $department_id = null){
        $task = Task::find($task_id);
        if ($department_id == null) {
            $department = null;
        }else{
            $department = Department::find($department_id);
        }
        return view('createTask', compact(['task', 'department']));
    }
    public function downloadPDF($task_id, $department_id = null){
        $task = Task::find($task_id);
        if ($department_id == null) {
            $department = null;
        }else{
            $department = Department::find($department_id);
        }
        $pdf = PDF::loadView('createTask', compact(['task', 'department']));
        $task->pdf = "$task->name.pdf";
        $task->save();
        Storage::put("public/pdf/$task->name.pdf", $pdf->output());
        return $pdf->download("$task->name.pdf");
    }
}
