<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('group_id')->unique();
            $table->string('timezone')->default('UTC');
            $table->time('reminder_time')->default('09:00:00');
            $table->timestamps();

            $table->foreign('group_id')->references('telegram_chat_id')->on('groups')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_settings');
    }
};
