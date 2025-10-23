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
        Schema::create('group_members', function (Blueprint $table) {
            $table->bigInteger('group_id');
            $table->bigInteger('user_id');
            $table->boolean('is_member')->default(true);
            $table->boolean('is_participating')->default(false);
            $table->string('role')->default('member');
            $table->timestamp('joined_at');
            $table->timestamps();

            $table->primary(['group_id', 'user_id']);
            $table->foreign('group_id')->references('telegram_chat_id')->on('groups')->cascadeOnDelete();
            $table->foreign('user_id')->references('telegram_id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_members');
    }
};
