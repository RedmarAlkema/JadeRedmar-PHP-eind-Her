<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
     public function show($id)
    {
        // Fetch the advertisement by its ID
        $advertisement = Advertisement::findOrFail($id);

        // Return the view with the advertisement data
        return view('advertisements.show', compact('advertisement'));
    }
}
