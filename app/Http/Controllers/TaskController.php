<?php

namespace App\Http\Controllers;

use App\Jobs\taskCreationJob;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //
    //
    public function index(){
        if ((Auth::user()->department_id != null && Auth::user()->role_id == 3) || Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            $tasks = Task::with(['user'])->where('user_id', Auth::user()->id)->get();
            if (Auth::user()->role_id == 3) {
                $personnels = User::where('role_id', 4)->where('department_id', Auth::user()->department_id)->with(['role'])->get();
            } else {
                $personnels = User::whereIn('role_id', [1, 3, 4])->with(['role'])->get();
            }

            return view('task/list')->with('tasks', $tasks)->with('personnels', $personnels);
        }else{
            return redirect()->route('dashboard')->with('error', 'Not allowed to access this page');
        }
    }

    public function viewTask($id){
        $task = Task::with(['user', 'user_task', 'user_task.user', 'user_task.user.role'])->find($id);
        if($task){
            $personIds = [];
            foreach ($task['user_task'] as $userTask) {
                array_push($personIds, $userTask->user_id);
            }

            if (Auth::user()->role_id == 3) {
                $personnels = User::where('id', '!=' , Auth::user()->id)->whereNotIn('id', $personIds)->where('role_id', 4)->where('department_id', Auth::user()->department_id)->with(['role'])->get();
            } else {
                $personnels = User::where('id', '!=' , Auth::user()->id)->whereNotIn('id', $personIds)->whereIn('role_id', [1, 3, 4])->with(['role'])->get();
            }

            return view('task/view')->with('task', $task)->with('personnels', $personnels);
        }else{
            return redirect()->route('dashboard')->with('error', "This task does not exist");
        }
    }
    public function createTask(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'description' => 'required'
        ]);

        if ($fields['endDate'] > $fields['startDate']) {
            if ($this->checkTaskName($fields['name'])) {
                    try {
                        //code...
                        $fields += [
                            "user_id" => Auth::user()->id
                        ];
                        $taskName = $fields['name'];
                        $task = Task::create($fields);

                        (new NotificationController)->sendNotification(Auth::user()->name, Auth::user()->email, "Task Creation", "You created a new task <br> <b>Name:</b> $taskName");
                        (new PDFController)->downloadPDF($task->id, Auth::user()->department_id);

                        return redirect()->back()->with('success', 'Task created successfully');
                    } catch (\Throwable $th) {
                        return redirect()->back()->with("error", $th->getMessage());
                    }
            } else {
                return redirect()->back()->with('error', 'This task is already in used');
            }
        } else {
            return redirect()->back()->with('error', 'The end date is smaller than the start date');
        }


    }

    public function addPersonnelTask($id, Request $request){

        try {
            //code...

            $users = User::get();
            foreach ($users as $user) {
                if ($request[$user->id] == 1) {
                    $task = Task::find($id);
                    UserTask::create([
                        'task_id' => $task->id,
                        'user_id' => $user->id
                    ]);
                    (new NotificationController)->sendNotification($user->name, $user->email, "Task Addition", "You were add to the task <br> <b>Name:</b> $task->name");
                }
            }

            return redirect()->back()->with('success', "Users added successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function removePersonnelTask($id, Request $request){

        try {
            //code...

            $users = User::get();
            foreach ($users as $user) {
                if ($request[$user->id] == 1) {
                    $task = Task::find($id);
                    UserTask::where(
                        'task_id', $task->id
                    )->where('user_id', $user->id)->delete();
                    (new NotificationController)->sendNotification($user->name, $user->email, "Task Deletion", "You were removed from  the task <br> <b>Name:</b> $task->name");
                }
            }

            return redirect()->back()->with('success', "Users removed successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public static function getUserDepartment(){
        $user = User::find(Auth::user()->id);
        $departments = Department::where('id', $user->department_id)->get();
        return $departments;
    }

    public function updateDepartment(Request $request)
    {
        $fields = $request->validate([
            'department_id' => 'required',
            'description' => 'required'
        ]);
        $department = Department::find($fields['department_id']);
        if ($department) {
            try {
                //code...
                $department->description = $fields['description'];
                $department->save();
                return redirect()->back()->with('success', 'Department updated successfully');
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with("error", $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'This Department does not exist');
        }
    }

    public function updateDepartmentStatus($status, $department_id)
    {

        $department = Department::find($department_id);
        if ($department) {
            try {
                //code...
                $department->status = $status;
                $department->save();
                $users = User::where('department_id', $department_id)->get();
                foreach ($users as $user) {
                    (new NotificationController)->sendNotification($user->name, $user->email, "Department Status Update", "Your department status has been updated <br> <b>New Status:</b> $status");
                }
                return redirect()->back()->with('success', 'Department updated successfully');
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with("error", $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'This Department does not exist');
        }
    }

    public function deleteDepartment($department_id)
    {

        $department = Department::find($department_id);
        if ($department) {
            try {
                //code...
                $users = User::where('department_id', $department_id)->get();
                User::where('department_id', $department_id)->update(['department_id'=> null]);
                foreach ($users as $user) {
                    (new NotificationController)->sendNotification($user->name, $user->email, "Department Deletion", "Your department has been deleted ");
                }
                Department::where('id', $department_id)->delete();
                return redirect()->back()->with('success', 'Department deleted successfully');
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with("error", $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'This Department does not exist');
        }
    }


    public function addUserDepartment($id, Request $request)
    {

        try {
            //code...

            $users = User::get();
            foreach ($users as $user) {
                if ($request[$user->id] == 1) {
                    $newUser = User::find($user->id);
                    $department = Department::find($id);

                    $newUser->department_id = $id;
                    $newUser->save();
                    (new NotificationController)->sendNotification($user->name, $user->email, "Department Addition", "You were add to the department <br> <b>Name:</b> $department->name");
                }
            }

            return redirect()->back()->with('success', "Users added successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function removeUserDepartment($id, Request $request)
    {

        try {
            //code...

            $users = User::get();
            foreach ($users as $user) {
                if ($request[$user->id] == 1) {
                    $newUser = User::find($user->id);
                    $department = Department::find($id);

                    $newUser->department_id = null;
                    $newUser->save();
                    (new NotificationController)->sendNotification($user->name, $user->email, "Department Removal", "You were removed from the department <br> <b>Name:</b> $department->name");
                }
            }
            return redirect()->back()->with('success', "Users added successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function checkTaskName($name)
    {
        if (Task::where('name', $name)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
