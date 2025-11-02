<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupSetting extends Model
{
    //    /** @use HasFactory<\Database\Factories\GroupSettingFactory> */
    //    use HasFactory;

    protected $fillable = [
        'group_id',
        'timezone',
        'reminder_time',
    ];

    protected $casts = [
        'reminder_time' => 'datetime:H:i:s',
    ];

    /**
     * Get the group that owns the settings.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id', 'telegram_chat_id');
    }
}
