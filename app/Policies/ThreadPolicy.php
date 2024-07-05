<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Thread;

class ThreadPolicy
{
    public function update(User $user, Thread $thread)
    {
        return $user->id === $thread->user_id;
    }    
}
