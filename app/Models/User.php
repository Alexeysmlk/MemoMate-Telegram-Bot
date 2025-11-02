<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    //    /** @use HasFactory<\Database\Factories\UserFactory> */
    //    use HasFactory;

    protected $primaryKey = 'telegram_id';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'telegram_id',
        'username',
        'first_name',
        'last_name',
        'birth_date',
        'custom_name',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_members', 'user_id', 'group_id')
            ->withPivot(['is_member', 'is_participating', 'role', 'joined_at'])
            ->withTimestamps();
    }
}
