<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffenseItem extends Model
{
    use HasFactory;

    protected $table = "offense_items";
    protected $fillable = ['offense_name', 'description'];
}
