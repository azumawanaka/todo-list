<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TaskAdded;
use App\Http\Requests\TaskFormRequest;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function update(Task $task)
    {
        $task = $this->taskService->updateTask($task);

        broadcast(new TaskAdded($task))->toOthers();

        return response($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
