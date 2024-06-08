<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'contract' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('contract')) {
            $file = $request->file('contract');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameWithExtension = $filename . '.' . $extension;

            // Save file to storage/app/public/files
            $filePath = 'files/' . $filenameWithExtension;
            Storage::disk('public')->put($filePath, file_get_contents($file->getRealPath()));

            // Save file information to the database
            $contract = new Contract([
                'file_path' => $filePath,
                'extension' => $extension,
                'user_id' => Auth::id(),
            ]);

            $contract->save();

            return redirect()->back()->with('success', 'Contract uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload contract.');
    }
}
