<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'isActive',
        'office_id',
        'preffred_program',
        'start_date',
        'start_time',
        'end_time',
        'number_of_sa',
        'status',
        'assignment_type',
        'to_be_done',
        'note',
        'assigned_office'
    ];

    public function officeUser(){
        return $this->belongsTo(User::class, 'office_id', 'id');
    }

    public function studentAssistants()
    {
        return $this->belongsToMany(User::class, 'user_tasks_timelog')
            ->withPivot('task_status') // Assuming 'status' is a column in the pivot table
            ->withTimestamps();
    }
}
