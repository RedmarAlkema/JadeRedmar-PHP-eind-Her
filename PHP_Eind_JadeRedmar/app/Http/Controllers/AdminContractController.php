<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $contract = Contract::find($id);
    
        if ($contract) {
            // Assuming the file_path is stored correctly
            $filePath = 'public/' . $contract->file_path;
            
            if (Storage::exists($filePath)) {
                return Storage::download($filePath);
            } else {
                return redirect()->route('contracts.index')->with('error', 'File does not exist.');
            }
        } else {
            return redirect()->route('contracts.index')->with('error', 'Invalid file ID.');
        }
    }
}
