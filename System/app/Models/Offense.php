<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'description',
        'status',
        'date_start',
        'date_end',
    ];

    public function saProfile()
    {
        return $this->belongsTo(SaProfile::class, 'user_id', 'user_id');
    }
}
