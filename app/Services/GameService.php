<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class GameService {

    private $game;

    public function __construct($roomCode = NULL)
    {
        if($roomCode) {
            $game = new Game();
            $this->game = $game->findByRoomCode($roomCode);
        }
    }

    /**
     * Check to see if the current user is an existing player and if both player slots are filled.
     * 
     * @return bool
     */
    public function canJoinRoom(): bool
    {
        if(!$this->game) return false;
        if($this->game->player_crosses == Auth::user()->id || $this->game->player_naughts == Auth::user()->id) return true;
        if(is_null($this->game->player_naughts)) { // No one currently playing as Naughts, add this user.
            $this->game->update(['player_naughts' => Auth::user()->id]);
            return true;
        }

        return false; // Current player cannot join room as two players are already selected.
    }

    public function postPlayerTurn($turn)
    {
        $board = $this->game->board;
        $board[$turn['boardSection']] = $turn['value'];
        
        $this->isWinner($board, $turn['value']) ? $this->game->updateTurnWithWinner($board, $turn) : $this->game->updateTurn($board, $turn);
    }

    /**
     * Check through matches matrix to see if the latest turn wins the game
     * 
     * @param array $board
     * @param string $value x|o
     * @return bool $isWinner
     */
    public function isWinner($board, $turnValue): bool
    {
        foreach(config('board.matches') as $matchPatterns) {
            $matchingValues = 0;
            foreach($matchPatterns as $key) {
                if($board[$key] === $turnValue) $matchingValues++;
            }

            if($matchingValues === 3) return true;
        }

        return false;
    }
}