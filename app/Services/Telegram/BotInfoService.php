<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use DefStudio\Telegraph\Models\TelegraphBot;

class BotInfoService
{
    public function getBotId(TelegraphBot $bot): int
    {
        return $bot->info()['id'];
    }

    public function getBotUsername(TelegraphBot $bot): string
    {
        return $bot->info()['username'];
    }

    public function getAddBotUrl(TelegraphBot $bot): string
    {
        $username = $this->getBotUsername($bot);

        return "https://t.me/{$username}?startgroup=true";
    }
}
