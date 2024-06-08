<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Advertisement::query();       

        if(Auth::user()->role == 'particulier'){
            $advertisements = $user->advertisements;

            // Get the latest contract for the user
            $latestContract = Contract::where('user_id', $user->id)->latest()->first();

            return view('dashboard.index', compact('user', 'advertisements', 'latestContract'));
        }
        else if(Auth::user()->role == 'admin'){
            $contracts = Contract::with('user')->get();
            return view('contracts.index', compact('contracts'));
        }
        else {
            // Filter by search term
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where('titel', 'like', '%' . $searchTerm . '%');
            }

            // Sort advertisements
            if ($request->has('sort_by')) {
                $sortBy = $request->input('sort_by');
                switch ($sortBy) {
                    case 'price_asc':
                        $query->orderBy('prijs');
                        break;
                    case 'price_desc':
                        $query->orderByDesc('prijs');
                        break;
                    case 'date_asc':
                        $query->orderBy('created_at');
                        break;
                    case 'date_desc':
                        $query->orderByDesc('created_at');
                        break;
                    case 'title_asc':
                        $query->orderBy('titel');
                        break;
                    case 'title_desc':
                        $query->orderByDesc('titel');
                        break;
                    default:
                        // Do nothing
                        break;
                }
            }

            // Fetch advertisements with pagination
            $advertisements = $query->paginate(10);

            // Fetch favorite advertisement IDs for the current user
            $favoriteAdvertisementIds = $user->favorites()->pluck('advertisement_id')->toArray();

            return view('home', compact('advertisements', 'favoriteAdvertisementIds'));
        }
    }
}
