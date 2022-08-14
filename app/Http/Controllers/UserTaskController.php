<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\Request;
use App\Models\User;

class UserTaskController extends Controller
{
    //


    public function addUserTask($id, Request $request)
    {

        try {
            //code...

            $users = User::get();
            foreach ($users as $user) {
                if ($request[$user->id] == 1) {
                    if ($this->checkUserTask($id, $user->id)) {
                        UserTask::create([
                            'task_id' => $id,
                            'user_id' => $user->id
                        ]);
                        $task = Task::find($id);
                        (new NotificationController)->sendNotification($user->name, $user->email, "Task Addition", "You were added to the task <br> <b>Name:</b> $task->name <br> <b>Description:</b> $task->description <br> <b>Start Date:</b> $task->startDate <br> <b>End Date:</b> $task->endDate");
                    }
                }
            }
            return redirect()->back()->with('success', "Users added successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function removeUserTask($id, Request $request)
    {

        try {
            //code...
            $users = User::get();
            foreach ($users as $user) {
                if ($request[$user->id] == 1) {
                    if ($this->checkUserTask($id, $user->id)) {
                        UserTask::where('task_id' , $id)->where('user_id' , $user->id)->delete();
                        $task = Task::find($id);
                        (new NotificationController)->sendNotification($user->name, $user->email, "Task Removal", "You were removed from the task <br> <b>Name:</b> $task->name ");
                    }
                }
            }
            return redirect()->back()->with('success', "Users removed successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function checkUserTask($task_id, $user_id)
    {
        if (UserTask::where('task_id', $task_id)->where('user_id', $user_id)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

}
