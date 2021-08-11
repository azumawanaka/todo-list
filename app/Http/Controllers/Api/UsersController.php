<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TaskFormRequest;
use App\Events\TaskAdded;
use App\Services\UserService;
use App\Services\TaskService;

class UsersController extends Controller
{
    /**
     * @var UserService $userService
     * @var TaskService $taskService
     */
    protected $userService;
    protected $taskService;

    public function __construct(UserService $userService, TaskService $taskService)
    {
        $this->userService = $userService;
        $this->taskService = $taskService;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userService->getUsers($request);
        return response()->json($users);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function store(TaskFormRequest $request)
    {
        $task = $this->taskService->storeTaskByUser($request);

        broadcast(new TaskAdded($task))->toOthers();

        $tasks = $this->taskService->getTaskByUserId($request->id, $request);
        return response()->json($tasks);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function show(int $userId, Request $request)
    {
        $tasks = $this->taskService->getTaskByUserId($userId, $request);
        return response()->json($tasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
