<?php

use App\Models\Game;
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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('room_code'); // Random 6 character room code.
            $table->enum('status', [
                Game::STATUS_IN_PROGRESS,
                Game::STATUS_COMPLETE,
                Game::STATUS_ABANDONED
            ])->default(Game::STATUS_IN_PROGRESS);
            $table->integer('player_crosses')->nullable();
            $table->integer('player_naughts')->nullable();
            $table->enum('current_turn', [
                Game::PLAYER_CROSSES,
                Game::PLAYER_NAUGHTS,
                Game::STATUS_COMPLETE
            ])->default(Game::PLAYER_CROSSES);
            $table->string('winner')->nullable();
            $table->json('board');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game');
    }
};
