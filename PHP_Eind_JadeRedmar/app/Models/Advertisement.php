<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'verkoper_naam',
        'verkoper_id',
        'titel',
        'beschrijving',
        'soort',
        'prijs',
        'eenheid',
    ];

    public function reviews()
    {
        return $this->belongsToMany(Review::class, 'advertisement_reviews');
    }
}
