<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Character;

class CharacterPolicy
{

    public function view(User $user, Character $character)
    {
        return $user->id === $character->user_id || ($user->admin) && ($character->enemy == 1);
    }

    public function update(User $user, Character $character)
    {
        return $user->id === $character->user_id || ($user->admin) && ($character->enemy == 1);
    }
}
