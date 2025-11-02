<?php

declare(strict_types=1);

namespace App\Actions\Group;

use App\Models\Group;
use App\Models\User;

class AddUserToGroupAction
{
    public function execute(Group $group, User $user): void
    {
        $group->users()->syncWithoutDetaching([
            $user->telegram_id => [
                'is_participating' => false,
                'joined_at' => now(),
            ],
        ]);
    }
}
