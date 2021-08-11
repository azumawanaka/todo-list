<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Task;
use Carbon\Carbon;

/**
 * Class TaskService.
 */
class TaskService
{
    public function getTaskByUserId(int $userId, $request): ?LengthAwarePaginator
    {
        return Task::where('user_id', $userId)
            ->orderBy('updated_at', 'DESC')
            ->paginate($request->limit);
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
        if ($request->completed_at === null) {
            $task->summary = $request->summary;
            $task->description = $request->description;
            $task->due_date = $request->remind !== null ? $task->due_date : $request->due_date;
            $task->remind = $request->remind;
        } else {
            if ($task->completed_at !== null) {
                $task->completed_at = null;
            } else {
                $task->completed_at = Carbon::now();
            }
        }

        $task->save();

        return $task;
    }

    public function storeTaskByUser($request): Task
    {
        $task = new Task();
        $task->user_id = $request->id;
        $task->summary = $request->summary;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();

        return $task;
    }

    public function fetchTaskBeforeDueDate()
    {
        $now = Carbon::now();
        return Task::where('due_date', '>=', $now->toDateTimeString())
            ->where('due_date', '<=', $now->addMinutes(5)->toDateTimeString())
            ->whereNull('completed_at')
            ->where('remind', '!=', 2)
            ->get();
    }

    public function updateTaskReminder(Task $task, int $remind): bool
    {
        $task->remind = $remind;
        return $task->save();
    }
}
