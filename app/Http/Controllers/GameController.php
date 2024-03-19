<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Services\GameService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class GameController extends Controller
{
    public function getHome()
    {
        return Inertia::render('Game/Home', ['roomRoute' => route('game.join')]);
    }    

    public function getCreateGame()
    {
        $game = Game::create();

        return redirect(route('game.play', ['roomCode' => $game->room_code]));
    }

    public function getPlayGame($roomCode, Game $model)
    {
        $game = $model->findByRoomCode($roomCode);

        return Inertia::render('Game/Board', [
            'game' => $game,
            'player' => $game->player_crosses == Auth::user()->id ? Game::PLAYER_CROSSES : Game::PLAYER_NAUGHTS,
            'submissionRoute' => route('game.turn', ['roomCode' => $roomCode])
        ]);
    }

    public function postJoinRoom()
    {
        $gameService = new GameService(request('roomCode', NULL));
        if(!$gameService->canJoinRoom()) {
            return redirect(route('game.home')); // Return back with errors
        }

        return redirect(route('game.play', ['roomCode' => request('roomCode')]));
    }

    public function postPlayerTurn($roomCode)
    {
        $gameService = new GameService($roomCode);
        $gameService->postPlayerTurn(request()->all());

        return redirect(route('game.play', ['roomCode' => $roomCode])); // Redirect for refresh until Ably integrated for socket broadcasting (live gameplay)
    }
}