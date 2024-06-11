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
        // Controleren op maximaal aantal biedingen
        // $userBidsCount = Auth::user()->bids()->count();
        // if ($userBidsCount >= 4) {
        //     return back()->with('error', 'Je mag maar maximaal 4 biedingen aanmaken.');
        // }

        // Controleren op maximaal aantal advertenties
        // $userAdsCount = Auth::user()->advertisements()->count();
        // if ($userAdsCount >= 4) {
        //     return back()->with('error', 'Je mag maar maximaal 4 advertenties aanmaken.');
        // }

        // // Controleren op maximaal aantal verhuur advertenties
        // $userRentalAdsCount = Auth::user()->advertisements()->where('type', 'verhuur')->count();
        // if ($request->type === 'verhuur' && $userRentalAdsCount >= 4) {
        //     return back()->with('error', 'Je mag maar maximaal 4 verhuur advertenties aanmaken.');
        // }

        // Validatie van de overige velden en opslaan van de advertentiegegevens
        $request->validate([
            'csv_file' => 'file|mimes:csv,txt',
            'title' => 'required',
            'description' => 'required',
            'url' => 'nullable|url',
            'price' => 'required|int',
            'type' => 'required'
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'url.url' => 'The URL format is invalid.',
            'price.required' => 'The price field is required.',
            'price.int' => 'The price must be an integer.',
            'csv_file.mimes' => 'The uploaded file must be a CSV file.'
        ]);

        // Handle CSV file upload...
        if ($request->hasFile('csv_file')) {
            // Handle CSV file upload logic here...
        }

        // Opslaan van de advertentie...
        $advertisement = new Advertisement();
        $advertisement->verkoper_id = Auth::id();
        $advertisement->verkoper_naam = Auth::user()->name;
        $advertisement->titel = $request->title;
        $advertisement->beschrijving = $request->description;
        $advertisement->url = $request->url;
        $advertisement->components = $request->components;
        $advertisement->eenheid = $request->eenheid;
        $advertisement->prijs = $request->price;
        $advertisement->type = $request->type;
        $advertisement->save();

        // Redirecten naar de juiste pagina of weergave met een succesbericht
        $user = Auth::user();
        $advertisements = $user->advertisements;
        return view('dashboard.index', compact('user', 'advertisements'));
        }   
}