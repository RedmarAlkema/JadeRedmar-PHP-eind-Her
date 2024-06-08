<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path', 
        'is_accepted',
        'user_id',
        'extension'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
