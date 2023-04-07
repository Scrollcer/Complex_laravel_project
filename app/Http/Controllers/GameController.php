<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    function index()
    {
        $games = Game::query()->get();
        return view('pages.game', ['games' => $games]);
    }

    function editPage()
    {
        $game = Game::find(request()->id);
        return view('pages.game_edit', ['tableData' => $game]);

    }

    function edit()
    {
        $game = Game::find(request()->id);
        $game->name = request()->name;
        $game->category_id = request()->category_id;
        $game->price = request()->price;
        $game->image = request()->file('image')->move('assets/img/games', 'public');;
        $game->description = request()->description;
        $game->save();
        return redirect('/');
    }

    function addPage()
    {
        return view('pages.game_add');
    }

    public function add(Request $request)
    {
        $game = new Game;
        $game->name = request()->name;
        $game->category_id = request()->category_id;
        $game->price = request()->price;
        $game->image = request()->file('image')->move('assets/img/games', 'public');
        $game->description = request()->description;
        $game->save();
        return redirect('/');
    }


    function delete()
    {
        Game::destroy(request()->id);
        return redirect('/');
    }
}
