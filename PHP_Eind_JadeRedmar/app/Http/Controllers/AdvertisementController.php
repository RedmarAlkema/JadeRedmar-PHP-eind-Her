<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdvertisementController extends Controller
{
    public function show($id)
    {
        $url = url()->current();
        $qrCode = QrCode::generate($url);
        $advertisement = Advertisement::with('user')->findOrFail($id);

        return view('advertisement', compact('advertisement','qrCode'));
    }

    public function create()
    {
        return view('dashboard.advertisementCreate');
    }

    public function store(Request $request)
    {     
        $request->validate([
            'csv_file' => 'file|mimes:csv,txt',
            'title' => 'required',
            'description' => 'required',
            'url' => 'nullable|url',
            'price' => 'required|int',
            'type' => 'required'
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'url.url' => 'The URL format is invalid.',
            'price.required' => 'The price field is required.',
            'price.int' => 'The price must be an integer.',
            'csv_file.mimes' => 'The uploaded file must be a CSV file.'
        ]);

        // Handle CSV file upload
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
    
            // Store the file temporarily
            $filePath = $file->storeAs('csv', 'temp.csv');
    
            // Read the CSV file
            $csv = Reader::createFromPath(storage_path('app/' . $filePath), 'r');
            $csv->setHeaderOffset(0); // Assumes the first row contains the column headers
    
            foreach ($csv as $row) {
                // Create advertisement for each row in the CSV
                Advertisement::create([
                    'verkoper_id' => Auth::id(),
                    'verkoper_naam' => Auth::user()->name,
                    'titel' => $row['title'],
                    'beschrijving' => $row['description'],
                    'url' => $row['url'] ?? null,
                    'eenheid' => $row['eenheid'],
                    'prijs' => $row['price'],                    
                    'type' =>  $row['type'],
                ]);
            }
    
            // Delete the temporary file
            Storage::delete($filePath);
        }  
                

        $user = Auth::user();
        $query = Advertisement::query();

        $advertisement = new Advertisement();
        $advertisement->verkoper_id = Auth::id();
        $advertisement->verkoper_naam = $user->name;
        $advertisement->titel = $request->title;
        $advertisement->beschrijving = $request->description;
        $advertisement->url = $request->url;
        $advertisement->components = $request->components;
        $advertisement->eenheid = $request->eenheid;
        $advertisement->prijs = $request->price;
        $advertisement->type = $request->type;
        $advertisement->save();

        $advertisements = $user->advertisements;
        
        return view('dashboard.index', compact('user', 'advertisements'));
    }

    
}