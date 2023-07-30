<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'data',
        'address',
    ];
    protected $casts = [
        'data' => 'array',
    ];

    function user()
    {

        return $this->belongsTo(User::class);
    }
}
