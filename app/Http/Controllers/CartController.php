<?php

namespace App\Http\Controllers;

use App\Game;
use App\Mail\SendEmail;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    function index()
    {
        $games = Game::query()->get();
        $orders = cart::query()->get();
        $email = cart::all()->last()->send_email;
        return view('pages.cart', ['games' => $games, 'orders' => $orders, 'send_email' => $email]);
    }

    function changeEmail()
    {
        $cart = cart::all()->last();
        $cart->send_email = request()->send_email;
        $cart->save();
        return redirect('/');
    }

    function store(Request $request)
    {
        $order = new cart;

        $order->name = request()->name;
        $order->email = request()->email;
        $order->game_id = request()->id;
        $email = cart::all()->last()->send_email;
        $order->send_email = $email;
        $order->save();
        $mailData = ['name' => $order->name, 'email' => $order->email, 'game_id' => $order->game_id];
        Mail::to("$order->send_email")->send(new SendEmail($mailData));
        return redirect('/');
    }
}
