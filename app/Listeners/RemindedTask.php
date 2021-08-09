<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\TaskReminder;

class RemindedTask implements ShouldQueue
{
    public function handle(TaskReminder $event)
    {
        $event->task->update([
            'remind' => 0,
        ]);
    }
}
