<?php

namespace App\Actions\User;

use App\Models\User;
use DefStudio\Telegraph\DTO\User as UserDTO;

class FindOrCreateUserAction
{
    public function execute(UserDTO $telegramUser): User
    {
        return User::updateOrCreate(
            [
                'telegram_id' => $telegramUser->id(),
            ],
            [
                'first_name' => $telegramUser->firstName(),
                'last_name' => $telegramUser->lastName(),
                'username' => $telegramUser->username(),
            ]
        );
    }
}
