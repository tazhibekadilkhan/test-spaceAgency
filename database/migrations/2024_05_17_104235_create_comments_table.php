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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->string('content')->nullable();
            $table->timestamps();

            $table->foreign('post_id')->on('posts')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('comment_id')->on('comments')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
