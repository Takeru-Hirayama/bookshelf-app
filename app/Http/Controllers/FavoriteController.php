<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $books = $user->favoriteBooks()->paginate(10);

        return view('favorites.index', compact('books'));
    }

    public function toggle(Book $book, Request $request): RedirectResponse
    {
        $request->user()->favoriteBooks()->toggle($book->id);

        return back();
    }
}
