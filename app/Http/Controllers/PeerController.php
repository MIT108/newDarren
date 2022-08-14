<?php

namespace App\Http\Controllers;

use App\Jobs\sendEmailJob;
use App\Models\Conference;
use App\Models\Peer;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Models\ConferenceUser;

class PeerController extends Controller
{
    //
    public function index()
    {

        $users = User::where('id', '!=', Auth::user()->id)->whereIn('status', array('active'))->get();
        return view('common/video/peer')
            ->with('users', $users);
    }

    public function createPeer(Request $request)
    {

        $fields = $request->validate([
            'receiver_id' => 'required',
            'programed' => ''
        ]);
        if ($fields['programed'] == null) {
            try {
                //code...

                $receiver = User::find($fields['receiver_id']);
                $sender = User::find(Auth::user()->id);
                $fields['sender_id'] = $sender->id;
                $room_id = $sender->id . "-" . $receiver->id . "-" . strtotime(Carbon::now());
                $fields['room_id'] = $room_id;
                $body = "$sender->id->name requested a meet with you";

                sendEmailJob::dispatch($receiver->name, $receiver->email, "Peer video Conference", $body);

                $body = "You requested a meeting to $receiver->name";

                sendEmailJob::dispatch($sender->name, $sender->email, "Peer video Conference", $body);

                Peer::create($fields);
                return redirect()->back()->with('success', 'Invitation send successfully');
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
                    $receiver = User::find($fields['receiver_id']);
                    $sender = User::find(Auth::user()->id);
                    $fields['sender_id'] = $sender->id;

                    $room_id = $sender->id . "-" . $receiver->id . "-" . strtotime(Carbon::now());
                    $fields['room_id'] = $room_id;
                    $time = $fields['programed']->format('Y-m-d H:i:s');
                    $body = "$sender->name requested a meet with you <br> Date and Time: $time";

                    sendEmailJob::dispatch($receiver->name, $receiver->email, "Peer video Conference", $body);

                    $body = "You requested a meeting to $receiver->name <br> Date and Time: $time";

                    sendEmailJob::dispatch($sender->name, $sender->email, "Peer video Conference", $body);

                    $fields['programed'] = strtotime($old);
                    Peer::create($fields);
                    return redirect()->back()->with('success', 'Invitation send successfully');
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with('error', $th->getMessage());
                }
            } else {
                return redirect()->back()->with('error', 'choose a valid date');
            }
        }
    }

    public static function getPeerRoomNotification()
    {
        $id = Auth::user()->id;
        $incoming = Peer::where('status', 'open')->where('receiver_id', $id)->get();
        $outgoing = Peer::where('status', 'open')->where('sender_id', $id)->get();

        foreach ($incoming as $in) {
            $user = User::find($in->sender_id);
            $in->sender_name = $user->name;
        }
        foreach ($outgoing as $in) {
            $user = User::find($in->receiver_id);
            $in->receiver_name = $user->name;
        }

        return [
            "incoming" => $incoming,
            "outgoing" => $outgoing
        ];
    }

    public function start($type, $room_id)
    {
        if ($type == 1) {
            $peer = Peer::find($room_id);
        } else {
            $peer = Conference::find($room_id);
        }

        if ($peer) {
            if ($peer->status == "open") {
                if ((int) $peer->programed <= strtotime(Carbon::now())) {
                    $peer->type = $type;
                    if ($type == 1) {
                        if (Auth::user()->id == $peer->sender_id || Auth::user()->id == $peer->receiver_id) {
                            return view('common/video/startPeer')->with('peer', $peer);
                        } else {
                            return redirect()->route('home')->with('error', 'You are not member of that room');
                        }
                    } else {
                        $creator = User::find($peer->creator);
                        if ($creator && $creator->status == "active") {
                            if (ConferenceUser::where('conference_id', $peer->id)->where('user_id', Auth::user()->id)->count() > 0) {
                                return view('common/video/startPeer')
                                    ->with('peer', $peer)
                                    ->with('creator', $creator);
                            } else {
                                return redirect()->route('home')->with('error', 'You are not a member of this meeting');
                            }
                        } else {
                            return redirect()->route('home')->with('error', 'The creator of this conference is not an active user');
                        }
                    }
                } else {
                    return redirect()->route('home')->with('error', 'Meeting time has not yet reached');
                }
            } else {
                return redirect()->route('home')->with('error', 'This meeting is now closed');
            }
        } else {
            return redirect()->route('home')->with('error', 'invalid room id');
        }
    }

    public function deletePeer($id)
    {
        try {
            //code...
            Peer::where('id', $id)->delete();
            return redirect()->back()->with('success', 'peer conference delete successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'could not delete the peer conference');
        }
    }
}
