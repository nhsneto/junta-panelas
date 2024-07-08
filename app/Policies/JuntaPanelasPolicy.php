<?php

namespace App\Policies;

use App\Models\JuntaPanelas;
use App\Models\User;

class JuntaPanelasPolicy
{
    public function update(User $user, JuntaPanelas $juntaPanelas): bool
    {
        return $user->id === $juntaPanelas->user_id;
    }

    public function delete(User $user, JuntaPanelas $juntaPanelas): bool
    {
        return $user->id === $juntaPanelas->user_id;
    }
}
