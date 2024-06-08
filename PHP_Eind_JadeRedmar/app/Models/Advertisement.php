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
        'url',
        'components',
        'start_time',
        'end_time',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'verkoper_id');
    }

    public function reviews()
    {
        return $this->hasManyThrough(Review::class, AdvertisementReview::class, 'advertisement_id', 'id', 'id', 'review_id');
    }
}
