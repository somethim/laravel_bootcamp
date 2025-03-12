<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->boolean('pinned')->default(false);
        });

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('chat_id')->constrained('chats');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('message');
            $table->foreignId('sender')->constrained('users')->cascadeOnDelete();
            $table->foreignId('chat_id')->constrained('chats')->cascadeOnDelete();
        });

        Schema::create('starred_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('message_id')->constrained('messages')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
