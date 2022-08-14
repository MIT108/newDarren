<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    //
    public function index(){
        $departments = Department::with(['user'])->get();
        $HOSs = User::where('role_id', 3)->where('department_id', null)->get();
        return view('department/list')->with('departments', $departments)->with('HOSs', $HOSs);
    }

    public function viewDepartment($id){
        $department = Department::with(['user'])->find($id);
        if($department){
            $personnels = User::where('role_id', 4)->where('department_id', null)->get();

            return view('department/view')->with('department', $department)->with('personnels', $personnels);
        }else{
            return redirect()->route('dashboard')->with('error', "This department does not exist");
        }
    }
    public function createDepartment(Request $request)
    {
        $fields = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($this->checkDepartmentName($fields['name'])) {
            $user = User::find($fields['user_id']);
            if ($user) {
                try {
                    //code...
                    $authUser = User::find(Auth::user()->id);
                    $department = Department::create($fields);
                    $user->department_id = $department->id;
                    $user->save();
                    $departmentName = $fields['name'];
                    (new NotificationController)->sendNotification($authUser->name, $authUser->email, "Department Creation", "you created a new department <br> <b>Name:</b> $departmentName");
                    (new NotificationController)->sendNotification($user->name, $user->email, "Department Creation", "you were added to a new department as HOS <br> <b>Name:</b> $departmentName");

                    return redirect()->back()->with('success', 'Department created successfully');
                } catch (\Throwable $th) {
                    return redirect()->back()->with("error", $th->getMessage());
                }
            } else {
                return redirect()->back()->with('error', 'This User does not exist');
            }
        } else {
            return redirect()->back()->with('error', 'This department is already in used');
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

    public function checkDepartmentName($name)
    {
        if (Department::where('name', $name)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
