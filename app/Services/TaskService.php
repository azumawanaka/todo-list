<?php

namespace App\Services;

use App\Http\Requests\TaskFormRequest;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

/**
 * Class TaskService.
 */
class TaskService
{
    public function getTaskByUserId(int $userId)
    {
        return Task::where('user_id', $userId)->get();
    }

    public function storeTask($request): Task
    {
        $task = new Task();
        $task->user_id = $request->user()->id;
        $task->summary = $request->summary;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();

        return $task;
    }

    public function updateTask(Task $task): Task
    {
        $task = $task->where('id', $task->id)->first();

        if (!$task->status) {
            $task->completed_at = Carbon::now();
        } else {
            $task->completed_at = null;
        }

        $task->save();

        return $task;
    }
}
