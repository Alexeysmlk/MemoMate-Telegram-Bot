<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    //    /** @use HasFactory<\Database\Factories\GroupFactory> */
    //    use HasFactory;

    protected $primaryKey = 'telegram_chat_id';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'telegram_chat_id',
        'title',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'user_id')
            ->withPivot(['is_member', 'is_participating', 'role', 'joined_at'])
            ->withTimestamps();
    }

    public function settings(): HasOne
    {
        return $this->hasOne(GroupSetting::class, 'group_id', 'telegram_chat_id');
    }
}
