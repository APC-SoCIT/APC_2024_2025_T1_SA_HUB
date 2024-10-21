<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_profile_id',
        'subject_code_id',
        'midterm_grade',
        'midterm_absences',
        'endterm_grade',
        'endterm_absences',
        'remarks',
        'final_grade'
    ];

    public function studentProfile(){
        return $this->belongsTo(SaProfile::class, 'student_profile_id', 'user_id');
    }

    public function subjectDetails(){
        return $this->belongsTo(SubjectOffering::class, 'subject_code_id', 'subject_code');
    }
}
