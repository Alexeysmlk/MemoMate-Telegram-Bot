<?php

namespace App\Models;

use DefStudio\Telegraph\Models\TelegraphBot;

class Bot extends TelegraphBot
{
    protected $table = 'telegraph_bots';

    protected $fillable = [
        'token',
        'name',
        'username',
    ];
}
