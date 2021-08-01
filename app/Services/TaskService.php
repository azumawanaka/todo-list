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
        return Task::where('user_id', $userId)->orderBy('updated_at', 'DESC')->get();
    }

    public function getTaskByTaskId(int $taskId)
    {
        return Task::where('id', $taskId)->first();
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

    public function updateTask(Task $task, $request): Task
    {
        if ($task->completed_at === null) {
            $task->completed_at = Carbon::now();
        } else {
            $task->completed_at = null;
        }

        $task->summary = $request->summary;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();

        return $task;
    }
}
