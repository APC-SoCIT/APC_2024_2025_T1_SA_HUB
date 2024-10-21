<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectOffering extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'subject_offerings';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'subject_code',
        'subject_name',
        'school_level_id',
        'term_id',
        'subject_code',
        'section',
        'type',
        'day_id',
        'room_type',
        'room_id',
        'remedial',
        'campus_id',
        'reference_id'
    ];

    // Optionally define any relationships here
}
