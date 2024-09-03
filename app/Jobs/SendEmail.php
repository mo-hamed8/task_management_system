<?php

namespace App\Jobs;

use App\Mail\ReminderEmail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user,public $task_id)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $task=Task::find($this->task_id);
        Mail::to($this->user->email)->send(new ReminderEmail($this->user->name,$task->task,$task->due_date));
        
    }
}
