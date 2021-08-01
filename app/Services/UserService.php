<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\TaskFormRequest;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

/**
 * Class UserService.
 */
class UserService
{
    public function getUsers(int $limit = 10): ?LengthAwarePaginator
    {
        return User::orderBy('updated_at', 'DESC')->paginate($limit);
    }
}
