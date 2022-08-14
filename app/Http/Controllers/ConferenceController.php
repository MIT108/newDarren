<?php

namespace App\Http\Controllers;

use App\Jobs\sendEmailJob;
use App\Models\Conference;
use App\Models\ConferenceUser;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ConferenceController extends Controller
{
    //
    public function index()
    {
        $conferences = Conference::whereIn('status', array('open'))->get();
        return view('common/video/conference')
            ->with('conferences', $conferences);
    }

    public function createConference(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'programed' => ''
        ]);

        if ($fields['programed'] == null) {
            try {
                //code...

                $creator = User::find(Auth::user()->id);
                $room_id = $creator->id . "-" . $creator->email . "-" . strtotime(Carbon::now());
                $fields['room_id'] = $room_id;
                $fields['creator'] = $creator->id;
                $name = $fields['name'];
                $description = $fields['description'];

                $body = "You created a meeting for: $name <br> Description: $description";
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', $th->getMessage());
            }
        } else {
            if (strtotime($fields['programed']) > strtotime(Carbon::now())) {
                try {
                    //code...
                    $old = $fields['programed'];
                    $fields['programed'] = explode('T', $fields['programed'])[0] . ' ' . explode('T', $fields['programed'])[1];
                    $fields['programed'] = DateTime::createFromFormat('Y-m-d H:i', $fields['programed']);

                    $creator = User::find(Auth::user()->id);
                    $fields['creator'] = $creator->id;

                    $room_id = $creator->id . "-" . $fields['name'] . "-" . strtotime(Carbon::now());
                    $fields['room_id'] = $room_id;
                    $name = $fields['name'];
                    $time = $fields['programed']->format('Y-m-d H:i:s');
                    $description = $fields['description'];

                    $body = "You created a meeting for : $name  <br> Date and Time: $time <br> Description: $description";
                    $fields['programed'] = strtotime($old);
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with('error', $th->getMessage());
                }
            } else {
                return redirect()->back()->with('error', 'choose a valid date');
            }
        }
        try {
            //code...
            (new NotificationController)->sendNotification($creator->name, $creator->email, "Video Conference", $body);

            $conference = Conference::create($fields);
            ConferenceUser::create([
                'user_id' => Auth::user()->id,
                'conference_id' => $conference->id
            ]);
            return redirect()->back()->with('success', 'Invitation send successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteConference($id)
    {

        try {
            //code...
            Conference::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Conference delete successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'could not delete the Conference');
        }
    }

    public function viewConference($id)
    {
        $conference = Conference::find($id);
        if ($conference) {
            $creator = User::find($conference->creator);
            if ($creator && $creator->status == 'active') {

                $users = ConferenceUser::where('conference_id', $conference->id)->with(['user', 'conference'])->get();
                $conferenceUsers = ConferenceUser::where('conference_id', $id)->get();
                $usersId = [];
                foreach ($conferenceUsers as $conferenceUser) {
                    array_push($usersId, $conferenceUser->user_id);
                }
                $notUsers = User::whereNotIn('id', $usersId)->where('status', 'active')->get();

                return view('common/video/viewConference')
                    ->with('creator', $creator)
                    ->with('users', $users)
                    ->with('notUsers', $notUsers)
                    ->with('conference', $conference);
            } else {
                return redirect()->route('home')->with('error', 'the creator of the conference is not an active user of the system');
            }
        } else {
            return redirect()->route('home')->with('error', 'could not find that conference');
        }
    }

    public function addUserConference($id, Request $request)
    {

        try {
            //code...

            $users = User::get();
            foreach ($users as $user) {
                if ($request[$user->id] == 1) {
                    if ($this->checkConferenceUser($id, $user->id)) {
                        ConferenceUser::create([
                            'conference_id' => $id,
                            'user_id' => $user->id
                        ]);
                        $conference = Conference::find($id);
                        $creator = User::find($conference->creator);

                        if ($conference->programed != null) {
                            $time = $conference->programed->format('Y-m-d H:i:s');
                            $body = "$creator->name created a meeting for : $conference->name  <br> Date and Time: $time <br> Description: $conference->description";
                        } else {
                            $body = "$creator->name created a meeting for: $conference->name <br> Description: $conference->description";
                        }


                        (new NotificationController)->sendNotification($user->name, $user->email, "Video Conference", $body);
                    }
                }
            }
            return redirect()->back()->with('success', "Users added successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function checkConferenceUser($conference_id, $user_id)
    {
        if (ConferenceUser::where('conference_id', $conference_id)->where('user_id', $user_id)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }


    public function deleteUserConference($conference_id, $user_id)
    {
        $conference = Conference::find($conference_id);
        if ($conference->creator == $user_id) {
            return redirect()->back()->with('error', "Cannot delete the creator of the conference");
        } else {
            try {
                //code...
                ConferenceUser::where('conference_id', $conference_id)->where('user_id', $user_id)->delete();
                return redirect()->back()->with('success', 'Deleted successful');
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', $th->getMessage());
            }
        }
    }

    public static function  getConferenceRoomNotification()
    {

        $id = Auth::user()->id;
        $incoming = Conference::where('status', 'open')->get();
        $outgoing = Conference::where('status', 'open')->where('creator', $id)->get();

        $incomingArray = [];

        foreach ($incoming as $in) {
            $user = User::find($in->creator);
            $in->sender_name = $user->name;
            if (ConferenceUser::where('conference_id', $in->id)->where('user_id', $id)->count() > 0 && $in->creator != $id) {
                array_push($incomingArray, $in);
            }
        }
        foreach ($outgoing as $in) {
            $user = User::find($in->creator);
            $in->receiver_name = $user->name;
        }


        return [
            "incomingConference" => $incomingArray,
            "outgoingConference" => $outgoing
        ];
    }
}
