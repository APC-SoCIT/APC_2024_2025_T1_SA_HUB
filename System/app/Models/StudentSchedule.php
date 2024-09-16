<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    use HasFactory;

    protected $table = 'student_schedules';

    protected $fillable = [
    'student_id',	
    'subject_offering_id',	
    'term_id',	
    'subject_code',	
    'enrollment_status_id',	
    'date_reference',	
    'remarks',	
    'confirmed_at',	
    'enrolled_at',
    ];
}
