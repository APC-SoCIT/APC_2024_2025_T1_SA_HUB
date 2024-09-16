<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaProfile extends Model
{
    use HasFactory;

    protected $table = 'sa_profiles';

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_initial',
        'gender',
        'contact_number',
        'birth_date',
        'birth_place',
        'course_program',
    ];
}
