<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //是限制：只有使用者自己可以刪除自己的 task。
    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
