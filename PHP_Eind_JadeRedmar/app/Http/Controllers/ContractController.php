<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'contract' => 'required|mimes:pdf|max:2048', // PDF file, max size 2MB
        ]);

        if ($request->hasFile('contract')) {
            $file = $request->file('contract');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('contracts', $fileName); // Store the file in the 'contracts' directory

            // Save file path to the database
            $contract = new Contract();
            $contract->file_path = $filePath;
            $contract->save();

            return redirect()->back()->with('success', 'Contract uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload contract.');
    }
}
