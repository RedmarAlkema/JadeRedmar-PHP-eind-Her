<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    protected $fillable = [
        'user_id',
        'advertisement_id',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
