<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $latestContract = Contract::where('user_id', $user->id)->latest()->first(); // Fetch the latest contract for the user

        return view('dashboard.index', compact('user', 'latestContract'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'background_color' => 'nullable|string|max:7',
            'intro_text' => 'nullable|string',
            'custom_url' => 'nullable|string', // Update validation rule to 'string'
            'company_description' => 'nullable|string',
        ]);

        $user->background_color = $request->background_color;
        $user->intro_text = $request->intro_text;
        $user->custom_url = $request->custom_url;
        $user->profile_url = $request->profile_url;
        $user->company_description = $request->company_description;
        $user->save();

        return redirect()->route('dashboard.index')->with('success', 'Dashboard customization updated successfully.');
    }

}
