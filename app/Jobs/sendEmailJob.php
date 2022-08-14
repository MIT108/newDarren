<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class sendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $recipientName , $recipientEmail, $subject, $body;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipientName, $recipientEmail, $subject, $body)
    {
        //
        $this->recipientName = $recipientName;
        $this->recipientEmail = $recipientEmail;
        $this->subject = $subject;
        $this->body = $body;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        app('App\Http\Controllers\EmailController')->sendMail($this->recipientName, $this->recipientEmail, $this->subject, $this->body);

    }
}
