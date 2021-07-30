<?php

namespace App\Services;

use App\Http\Requests\TaskFormRequest;
use App\Models\User;
use App\Models\Task;

/**
 * Class TaskService.
 */
class TaskService
{
    // private $agencyRepository;

    public function __construct() {
        // $this->agencyRepository = $agencyRepository;
    }

    public function storeTask(User $user, TaskFormRequest $request): Task
    {
        $task = new Task();
        $task->user_id = $user->id;
        $task->summary = $request->summary;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();

        return $task;
    }

    public function updateTask(int $taskId): Task
    {
        $task = new Task();
        $task = $task->where('id', $taskId)->first();

        if ($task->status === 0) {
            $task->status = 1;
        } else {
            $task->status = 0;
        }

        $task->save();

        return $task;
    }
}
