<?php

namespace App\Http\Controllers;

use App\Jobs\sendEmailJob;
use Illuminate\Http\Request;
use App\Models\User;

class TrashController extends Controller
{
    //
    public function deletedUsersList(){
        $users = User::with(['role'])
        ->where('id', '!=', 1)
        ->whereIn('status', array('deleted'))->get();
        return view('common/deletedUser')
        ->with('users', $users);
    }

    public function restoreUser($id){

        try {
            //code...
            $user = User::find($id);
            if ($user) {
                $user->status = 'inactive';
                $user->save();

                $body = "
                    Your account has been Restored!!<br>
                ";
                sendEmailJob::dispatch($user->name, $user->email, "Account Suspension", $body);
                return redirect()->back()->with('success', 'User restored successful');
            } else {
                return redirect()->back()->with('error', 'this user does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
