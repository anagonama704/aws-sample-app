<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        //
        $this->authorize(Like::class);
        $books = \Auth::user()->likeBooks()->orderBy('created_at', 'desc')->paginate(15);
        return view('likes.index', ['books' => $books]);
    }
    public function store(Request $request)
    {
        //
        $this->authorize(Like::class);
        \Auth::user()->likeBooks()->attach($request->book_id);
        return back();
    }
    public function destroy(Request $request)
    {
        //
        $this->authorize(Like::class);
        \Auth::user()->likeBooks()->detach($request->book_id);
        return back();
    }
}
