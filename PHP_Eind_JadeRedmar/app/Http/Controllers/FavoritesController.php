<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorites;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->favorites()->with('advertisement');

        // Filter by search term
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->whereHas('advertisement', function ($query) use ($searchTerm) {
                $query->where('titel', 'like', '%' . $searchTerm . '%');
            });
        }

        // Sort by price, date, or title
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            switch ($sortBy) {
                case 'price_asc':
                    $query->orderBy('advertisement.prijs');
                    break;
                case 'price_desc':
                    $query->orderByDesc('advertisement.prijs');
                    break;
                case 'date_asc':
                    $query->orderBy('favorites.created_at');
                    break;
                case 'date_desc':
                    $query->orderByDesc('favorites.created_at');
                    break;
                case 'title_asc':
                    $query->orderBy('advertisement.titel');
                    break;
                case 'title_desc':
                    $query->orderByDesc('advertisement.titel');
                    break;
                default:
                    // Do nothing
                    break;
            }
        }

        // Fetch favorite advertisements with pagination
        $favorites = $query->paginate(10);

        return view('favorites', compact('favorites'));
    }
    
    public function favorite($id)
    {
        $user = Auth::user();

        if (!Favorites::where('user_id', $user->id)->where('advertisement_id', $id)->exists()) {
            Favorites::create([
                'user_id' => $user->id,
                'advertisement_id' => $id,
            ]);
        }

        return redirect()->route('home');
    }

    public function unfavorite($id)
    {
        $user = Auth::user();
        
        Favorites::where('user_id', $user->id)->where('advertisement_id', $id)->delete();

        return redirect()->route('home');
    }
}
