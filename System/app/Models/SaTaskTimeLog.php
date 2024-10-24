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
        'is_Approved_In', // make this null
        'is_Approved_out', // make this null
        'feedback',
    ];

    // public function task(){
    //     return $this->belongsTo(Task::class);
    // }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function task(){
        return $this->belongsTo(Task::class, 'task_id');
    }



}
