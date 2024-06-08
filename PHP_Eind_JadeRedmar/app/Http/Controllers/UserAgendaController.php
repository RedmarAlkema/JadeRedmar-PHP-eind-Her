<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Advertisement;
use App\Models\Purchase;

class UserAgendaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $purchases = Purchase::where('user_id', $user->id)
                     ->with('advertisement')
                     ->get();


        return view('user-agenda', compact('purchases'));
    }
}
