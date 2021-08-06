<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Task;

class DummyData extends Seeder
{
    private static $accountList = [
        'users' => [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => '111111',
                'role' => 1,
            ],
            [
                'name' => 'Jade',
                'email' => 'user@example.com',
                'password' => '111111',
                'role' => 0,
            ],
            [
                'name' => 'Filjumar',
                'email' => 'user2@example.com',
                'password' => '111111',
                'role' => 0,
            ],
        ],
    ];

    private static $tasksLists = [
        'tasks' => [
            [
                'summary' => 'Summary A',
                'description' => 'Description A',
                'completed_at' => null,
            ],
            [
                'summary' => 'Summary B',
                'description' => 'Description B',
                'completed_at' => null,
            ],
        ],
    ];

    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('tasks')->truncate();

        foreach (self::$accountList['users'] as $key => $userAccount) {
            $user[$key] = $this->createUser($userAccount);

            if ($user[$key]->role === 0) {
                foreach (self::$tasksLists['tasks'] as $task) {
                    $this->createTask($user[$key], $task);
                }
            }
        }
    }

    private function createUser(array $user): User
    {
        $newUser = new User();
        $newUser->name = $user['name'];
        $newUser->email = $user['email'];
        $newUser->role = $user['role'];
        $newUser->password = bcrypt($user['password']);
        $newUser->save();

        return $newUser;
    }

    private function createTask(object $user, array $task): bool
    {
        $newTask = new Task();
        $newTask->user_id = $user->id;
        $newTask->summary = $task['summary'];
        $newTask->description = $task['description'];
        $newTask->due_date = \Carbon\Carbon::now();
        $newTask->completed_at = $task['completed_at'];

        return $newTask->save();
    }
}
