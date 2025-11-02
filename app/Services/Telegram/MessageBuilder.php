<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use DefStudio\Telegraph\Keyboard\Keyboard;

class MessageBuilder
{
    public function buildAddBotKeyboard(string $botUsername): Keyboard
    {
        return Keyboard::make()
            ->button(__('telegram.private.buttons.add_bot_to_group'))
            ->url("https://t.me/{$botUsername}?startgroup=true");
    }

    public function buildGreetingMessage(string $firstName, string $botUsername): array
    {
        return [
            'message' => __('telegram.private.messages.greeting_with_instruction', ['name' => $firstName]),
            'keyboard' => $this->buildAddBotKeyboard($botUsername),
        ];
    }
}
