<?php

declare(strict_types=1);

namespace App\Telegram\Handlers;

use App\Actions\User\FindOrCreateUserAction;
use App\Models\Group;
use DefStudio\Telegraph\DTO\Chat;
use DefStudio\Telegraph\DTO\User;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Keyboard;

class TelegramWebhookHandler extends WebhookHandler
{
    public function __construct(
        protected FindOrCreateUserAction $findOrCreateUserAction,
    ) {
        parent::__construct();
    }

    public function start(): void
    {
        if ($this->message->chat()->type() === Chat::TYPE_PRIVATE) {
            $userDto = $this->message->from();

            $this->findOrCreateUserAction->execute($userDto);

            $firstName = $userDto->firstName() ?: 'друг';

            $this->chat
                ->message(__('telegram.private.messages.greeting_with_instruction', ['name' => $firstName]))
                ->keyboard(
                    Keyboard::make()
                        ->button(__('telegram.private.buttons.add_bot_to_group'))
                        ->url('https://t.me/'.$this->bot->username.'?startgroup=true')
                )
                ->send();

            return;
        }

        $this->chat->message(__('telegram.group.messages.redirect_user_to_private_chat'))->send();
    }

    protected function handleChatMemberJoined(User $member): void
    {
        $botId = $this->bot->info()['id'];

        if ($member->id() === $botId) {
            $from = $this->message?->from();

            if ($from === null) {
                return;
            }

            $inviter = $this->findOrCreateUserAction->execute($from);

            $group = Group::updateOrCreate(
                [
                    'telegram_chat_id' => $this->message->chat()->id(),
                ],
                [
                    'title' => $this->message->chat()->title(),
                ]
            );

            $group->users()->syncWithoutDetaching([
                $inviter->telegram_id => [
                    'is_participating' => false,
                    'joined_at' => now(),
                ],
            ]);

            $this->chat->message('Hello everyone!')->send();
        }
    }
}
