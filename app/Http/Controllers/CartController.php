<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //
        $this->authorize(Cart::class);
        $carts = Cart::where('user_id', '=', \Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
        return view('carts.index', ['carts' => $carts]);
    }
    public function store(Request $request, Cart $cart)
    {
        //
        $this->authorize($cart);
        \Auth::user()->cart()->attach($request->book_id);
        return back();
    }
    public function destroy(Request $request, Cart $cart)
    {
        //
        $this->authorize($cart);
        \Auth::user()->cart()->detach($request->book_id);
        return back();
    }
}
