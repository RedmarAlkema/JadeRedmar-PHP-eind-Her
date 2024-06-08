<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename', // Assuming you'll store the filename in the database
        'status',   // Status of the contract (e.g., pending, accepted, rejected)
    ];
}
