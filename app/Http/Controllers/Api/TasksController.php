<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskFormRequest;
use Illuminate\Http\Request;
use App\Events\TaskAdded;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;
use App\Services\TaskService;
use App\Models\Task;

class TasksController extends Controller
{
    /**
     * @var TaskService $taskService
     */
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->middleware('auth');
        $this->taskService = $taskService;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = $this->taskService->getTaskByUserId($request->user()->id);
        return response($tasks);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function store(TaskFormRequest $request)
    {
        $task = $this->taskService->storeTask($request);

        broadcast(new TaskAdded($task))->toOthers();

        return response($task);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $tasks = $this->taskService->getTaskByTaskId($task->id);
        return response($tasks);
    }

    public function update(Task $task, TaskFormRequest $request)
    {
        $task = $this->taskService->updateTask($task, $request);

        broadcast(new TaskUpdated($task))->toOthers();

        return response($task);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        broadcast(new TaskDeleted($task))->toOthers();

        return response();
    }
}
