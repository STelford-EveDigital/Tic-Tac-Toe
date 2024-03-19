<?php

namespace App\Traits;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;

trait GameBoard
{
    protected static function bootGameBoard()
    {
        static::creating(function($model) {
            $model->player_crosses = Auth::user()->id;
            $model->current_turn = Game::PLAYER_CROSSES;
            $model->board = config('board.blank');
            $model->room_code = bin2hex(openssl_random_pseudo_bytes(3)); // Generate random 6 character room code
        });
    }
}