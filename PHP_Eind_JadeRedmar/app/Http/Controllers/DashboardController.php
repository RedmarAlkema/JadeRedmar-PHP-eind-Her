<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $advertisements = $user->advertisements;

        return view('dashboard.index', compact('user', 'advertisements'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'background_color' => 'nullable|string|max:7',
            'intro_text' => 'nullable|string',
            'custom_url' => 'nullable|url',
            'company_description' => 'nullable|string',
        ]);

        $user->background_color = $request->background_color;
        $user->intro_text = $request->intro_text;
        $user->custom_url = $request->custom_url;
        $user->company_description = $request->company_description;
        $user->save();

        return redirect()->route('dashboard.index')->with('success', 'Dashboard customization updated successfully.');
    }
}
