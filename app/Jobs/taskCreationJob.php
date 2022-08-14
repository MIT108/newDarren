<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\PDFController;

class taskCreationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $department_id , $task_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($task_id, $department_id)
    {
        //
        $this->task_id = $task_id;
        $this->department_id = $department_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new PDFController)->downloadPDF($this->task_id, $this->department_id);
        //
    }
}
