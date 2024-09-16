<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaTaskTimeLog extends Model
{
    protected $table = 'user_tasks_timelog'; 

    protected $fillable = [
        'task_status',
        'task_id',
        'user_id',
        'time_in',
        'time_out',
        'total_hours',
        'is_Approved_In',
        'is_Approved_out',
        'feedback',
    ];
}
