<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class AdminContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with('user')->get();
        return view('contracts.index', compact('contracts'));
    }

    public function approve($id)
    {
        $contract = Contract::findOrFail($id);
        $contract->is_accepted = true;
        $contract->save();

        return redirect()->route('contracts.index')->with('success', 'Contract approved successfully.');
    }

    public function reject($id)
    {
        $contract = Contract::findOrFail($id);
        $contract->is_accepted = false;
        $contract->save();

        return redirect()->route('contracts.index')->with('success', 'Contract rejected successfully.');
    }

    public function download($id)
    {
        $file = Contract::find($id);
    
        if ($file) {
            $path = storage_path('app/public/files/' . $file->file_path);
    
            if (file_exists($path)) {
                return response()->download($path);
            } else {
                return redirect()->route('contracts.index')->with('error', 'File does not exist.');
            }
        } else {
            return redirect()->route('contracts.index')->with('error', 'Invalid file ID.');
        }
    }
}
