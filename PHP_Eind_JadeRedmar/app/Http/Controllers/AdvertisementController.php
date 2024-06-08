<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    public function show($id)
    {
        $advertisement = Advertisement::with('user')->findOrFail($id);
        return view('advertisement', compact('advertisement'));
    }
}