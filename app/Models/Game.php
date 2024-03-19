<?php

namespace App\Models;

use App\Traits\GameBoard;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory, GameBoard;

    public const PLAYER_CROSSES = 'crosses';
    public const PLAYER_NAUGHTS = 'naughts';

    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETE = 'complete';
    public const STATUS_ABANDONED = 'abandoned';

    public const WINNER_TIED = 'tied';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'player_crosses',
        'player_naughts',
        'current_turn',
        'winner',
        'board'
    ];

    protected $casts = [ 
        'board' => 'array'
    ];

    public function findByRoomCode($roomCode): Collection|Game
    {
        return $this::where('room_code', $roomCode)->first();
    }

    public function updateTurn($board, $turn)
    {
        self::update([
            'board' => $board,
            'current_turn' => $turn['value'] == 'x' ? Game::PLAYER_NAUGHTS : Game::PLAYER_CROSSES
        ]);
    }

    public function updateTurnWithWinner($board, $turn)
    {
        self::update([
            'status' => self::STATUS_COMPLETE,
            'current_turn' => self::STATUS_COMPLETE,
            'winner' => $turn['value'] == 'x' ? Game::PLAYER_CROSSES : Game::PLAYER_NAUGHTS,
            'board' => $board,
        ]);
    }
}
