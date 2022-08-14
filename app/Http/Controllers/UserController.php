<?php

namespace App\Http\Controllers;

use App\Jobs\sendEmailJob;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function createUser(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ]);

        if (!$this->checkUserEmail($fields['email'])) {
            $password = Str::random(8);
            $fields += ['password' => Hash::make($password)];
            $role = Role::find($fields['role_id']);
            $email = $fields['email'];
            $name = $fields['name'];
            $body = "
                Your account created successfully!!<br>
                Role: $role->name<br/>
                Email: $email<br/>
                Name: $name<br/>
                Password: $password<br/>
            ";
            sendEmailJob::dispatch($name, $email, "Account Creation", $body);
            User::create($fields);
            return back()->with('success', "$role->name account created successfully");
        } else {
            $user = User::where('email', '=', $fields['email'])->get()[0];
            if ($user->status == 'deleted') {
                return redirect()->back()->with('warning', 'This user has been deleted! Go the trash and restore the user');
            } else {
                return back()->with('error', 'Email already exist in the system');
            }
        }
    }

    public function checkUserEmail($email)
    {
        if (User::where('email', '=', $email)->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function viewUser($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('common/user/viewUser')
                ->with('user', $user);
        } else {
            return redirect()->route('home')->with('error', 'this user does not exist');
        }
    }


    public function suspendUser($id)
    {
        try {
            //code...
            $user = User::find($id);
            if ($user) {
                $user->status = 'inactive';
                $user->save();

                $body = "
                    Your account has been suspended!!<br>
                ";
                sendEmailJob::dispatch($user->name, $user->email, "Account Suspension", $body);
                return redirect()->back()->with('success', 'User suspended successful');
            } else {
                return redirect()->back()->with('error', 'this user does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function activateUser($id)
    {
        try {
            //code...
            $user = User::find($id);
            if ($user) {
                $user->status = 'active';
                $user->save();
                $body = "
                    Your account has been Activated!!<br>
                ";
                sendEmailJob::dispatch($user->name, $user->email, "Account Activation", $body);
                return redirect()->back()->with('success', 'user activated successful');
            } else {
                return redirect()->back()->with('error', 'this user does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user->status == 'active') {
            return redirect()->back()->with('error', 'Cant delete Active user');
        } else {
            try {
                //code...
                $user = User::find($id);
                $user->status = 'deleted';
                $user->save();

                $body = "
                    Your account has been deleted!!<br>
                ";
                sendEmailJob::dispatch($user->name, $user->email, "Account Deletion", $body);
                return redirect()->back()->with('success', 'User activated successful');
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', $th->getMessage());
            }
        }
    }

    public function userProfile($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('common/user/viewUser')
                ->with('user', $user);
        } else {
            return redirect()->route('home')->with('error', 'this user does not exist');
        }
    }
    public function userEdit()
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            return view('common/user/editUser')
                ->with('user', $user);
        } else {
            return redirect()->route('home')->with('error', 'this user does not exist');
        }
    }

    public function editProfileImage(Request $request)
    {

        $fields = $request->validate([
            'image' => 'required|file',
        ]);

        $user = User::find(Auth::user()->id);
        if ($user) {

            try {
                //code...
                $imageFullName = $request->file('image')->getClientOriginalName();
                $fileName = strtotime(Carbon::now()) . $imageFullName;
                $fields['image'] = $fileName;

                try {
                    $user->image = $fields['image'];
                    $user->save();


                    $request->file('image')->storeAs('public/users', $fileName);

                    return redirect()->back()->with('success', 'Profile image updated successfully');
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with('error', $th->getMessage());
                }
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', $th->getMessage());
            }
        } else {
            return redirect()->route('home')->with('error', 'this user does not exist');
        }
    }
    public function editProfilePassword(Request $request)
    {

        $fields = $request->validate([
            'oldPassword' => 'required',
            'password' => 'required',
            'cPassword' => 'required'
        ]);


        $user = User::find(Auth::user()->id);
        if ($user) {

            if ($fields['password'] == $fields['cPassword']) {
                $attributes = [
                    'password' => $fields['oldPassword'],
                    'email' => $user->email
                ];
                if (Auth::attempt($attributes)) {
                    try {
                        //code...
                        $user->password = Hash::make($fields['password']);
                        $user->save();
                        return redirect()->back()->with('success', 'Profile password updated successfully');
                    } catch (\Throwable $th) {
                        //throw $th;
                        return redirect()->back()->with('error', $th->getMessage());
                    }
                } else {
                    return redirect()->back()->with('error', 'Old password is invalid');
                }
            } else {
                return redirect()->back()->with('error', 'The two passwords does not match.');
            }
        } else {
            return redirect()->route('home')->with('error', 'this user does not exist');
        }
    }

    public function editProfileInformation(Request $request)
    {

        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'phone'     => ['required', 'max:50'],
            'location' => ['required', 'max:70'],
            'about_me'    => ['required'],
        ]);


        $user = User::find(Auth::user()->id);
        if ($user) {

            try {
                //code...

                $user->name = $attributes['name'];
                $user->phone = $attributes['phone'];
                $user->location = $attributes['location'];
                $user->about_me = $attributes['about_me'];
                $user->save();
                return redirect()->back()->with('success', 'Profile information updated successfully');

            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', $th->getMessage());
            }
        } else {
            return redirect()->route('home')->with('error', 'this user does not exist');
        }
    }
}
