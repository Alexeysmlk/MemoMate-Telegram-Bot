<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupMember extends Pivot
{
    protected $table = 'group_members';

    public $incrementing = true;

    protected function casts(): array
    {
        return [
            'is_member' => 'boolean',
            'is_participating' => 'boolean',
            'role' => UserRole::class,
            'joined_at' => 'datetime',
        ];
    }
}
