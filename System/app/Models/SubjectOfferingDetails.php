<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectOfferingDetails extends Model
{
    use HasFactory;

    protected $table = "subject_offering_details";

    protected $casts = [
        'time_constraints' => 'array',
    ];

    protected $fillable = [
        'subject_offering_id',
        'time_constraints',
        'instructors',
        'prerequisites',
    ];
}
