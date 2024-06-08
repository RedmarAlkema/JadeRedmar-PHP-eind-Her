<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function show($id)
    {
        $advertisement = Advertisement::with('user')->findOrFail($id);
        return view('advertisement', compact('advertisement'));
    }

    public function create()
    {
        return view('dashboard.advertisementCreate');
    }

    public function store(Request $request)
    {

        
        

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'nullable|url',
            'components' => 'nullable|json',
        ]);

        $user = Auth::user();
        $query = Advertisement::query();

        $advertisement = new Advertisement();
        $advertisement->verkoper_id = Auth::id();
        $advertisement->verkoper_naam = $user->name;
        $advertisement->titel = $request->title;
        $advertisement->beschrijving = $request->description;
        $advertisement->url = $request->url;
        $advertisement->components = $request->components;
        $advertisement->prijs = $request->price;
        $advertisement->save();

        $advertisements = $user->advertisements;
        
        return view('dashboard.index', compact('user', 'advertisements'));
    }
}