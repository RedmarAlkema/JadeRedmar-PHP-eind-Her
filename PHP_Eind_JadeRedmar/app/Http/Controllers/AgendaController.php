<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Advertisement;

class AgendaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $advertisements = Advertisement::where('verkoper_id', $user->id)
                                        ->whereNotNull('start_time')
                                        ->whereNotNull('end_time')
                                        ->orderBy('start_time', 'asc')
                                        ->get();

        return view('dashboard.agenda', compact('advertisements'));
    }
}
