<?php

declare(strict_types=1);

namespace App\Actions\Group;

use App\Models\Group;
use DefStudio\Telegraph\DTO\Chat;

class FindOrCreateGroupAction
{
    public function execute(Chat $chat): Group
    {
        return Group::updateOrCreate(
            [
                'telegram_chat_id' => $chat->id(),
            ],
            [
                'title' => $chat->title(),
            ]
        );
    }
}
