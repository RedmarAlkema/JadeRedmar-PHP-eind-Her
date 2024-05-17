<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorites;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{    
    public function index()
    {
        $userId = Auth::id();

        $favorites = Favorites::where('user_id', $userId)
                             ->orderBy('created_at', 'desc')
                             ->get();

    return view('favorites', compact('favorites'));
    }

    
}
