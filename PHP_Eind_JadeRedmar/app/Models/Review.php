<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'content',
        'rating',
        'user_id',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advertisementReviews()
    {
        return $this->hasMany(AdvertisementReview::class);
    }
}
