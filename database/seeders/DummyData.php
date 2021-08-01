<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
                'name' => 'user',
                'email' => 'user@example.com',
                'password' => '111111',
                'role' => 0,
            ],
        ],
    ];

    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('tasks')->truncate();

        foreach (self::$accountList['users'] as $key => $userAccount) {
            $this->createUser($userAccount);
        }
    }

    private function createUser(array $user): bool
    {
        $newUser = new User();
        $newUser->name = $user['name'];
        $newUser->email = $user['email'];
        $newUser->role = $user['role'];
        $newUser->password = bcrypt($user['password']);
        return $newUser->save();
    }
}
