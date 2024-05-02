<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;

class HomeController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::orderBy('created_at', 'desc')->paginate(10); 
        return view('home', compact('advertisements'));
    }
}
