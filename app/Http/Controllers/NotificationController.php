<?php

namespace App\Http\Controllers;

use App\Jobs\sendEmailJob;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function sendNotification($receiverName, $receiverEmail, $subject, $body){

        sendEmailJob::dispatch($receiverName, $receiverEmail, $subject, $body);
    }
}
