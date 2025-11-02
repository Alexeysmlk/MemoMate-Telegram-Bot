<?php

declare(strict_types=1);

namespace App\Telegram\Handlers;

use App\Actions\Group\AddUserToGroupAction;
use App\Actions\Group\FindOrCreateGroupAction;
use App\Actions\User\FindOrCreateUserAction;
use App\Services\Telegram\BotInfoService;
use App\Services\Telegram\MessageBuilder;
use DefStudio\Telegraph\DTO\Chat;
use DefStudio\Telegraph\DTO\User;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class TelegramWebhookHandler extends WebhookHandler
{
    public function __construct(
        protected FindOrCreateUserAction $findOrCreateUserAction,
        protected FindOrCreateGroupAction $findOrCreateGroupAction,
        protected AddUserToGroupAction $addUserToGroupAction,
        protected BotInfoService $botInfoService,
        protected MessageBuilder $messageBuilder,
    ) {
        parent::__construct();
    }

    public function start(): void
    {
        if ($this->isPrivateChat()) {
            $this->handlePrivateChatStart();

            return;
        }

        $this->chat->message(__('telegram.group.messages.redirect_user_to_private_chat'))->send();
    }

    protected function handleChatMemberJoined(User $member): void
    {
        if (! $this->isBot($member)) {
            return;
        }

        $messageSender = $this->getMessageSender();
        
        if ($messageSender === null) {
            return;
        }

        $user = $this->findOrCreateUserAction->execute($messageSender);
        $group = $this->findOrCreateGroupAction->execute($this->message->chat());

        $this->addUserToGroupAction->execute($group, $user);

        $this->chat->message(__('telegram.group.messages.new_chat_members'))->send();
    }

    protected function isPrivateChat(): bool
    {
        return $this->message->chat()->type() === Chat::TYPE_PRIVATE;
    }

    protected function isBot(User $member): bool
    {
        return $member->id() === $this->botInfoService->getBotId($this->bot);
    }

    protected function getMessageSender(): ?User
    {
        return $this->message?->from();
    }

    protected function handlePrivateChatStart(): void
    {
        $userDto = $this->message->from();
        $this->findOrCreateUserAction->execute($userDto);

        $greeting = $this->messageBuilder->buildGreetingMessage(
            $userDto->firstName() ?: 'друг',
            $this->botInfoService->getBotUsername($this->bot)
        );

        $this->chat
            ->message($greeting['message'])
            ->keyboard($greeting['keyboard'])
            ->send();
    }
}
