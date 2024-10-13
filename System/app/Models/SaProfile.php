<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaProfile extends Model
{
    use HasFactory;

    protected $table = 'sa_profiles';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_initial',
        'gender',
        'contact_number',
        'birth_date',
        'birth_place',
        'course_program',
        'status'
    ];

    public function studentUser(){
        return $this->belongsTo(User::class, 'user_id', 'id_number' );
    }

    public function offenses(){
        return $this->hasMany(Offense::class, 'user_id','user_id' );
    }
}
