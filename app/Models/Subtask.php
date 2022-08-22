<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'status',
        'priority',
        'deadline',
        'privilege',
        'start_time',
        'end_time',
        'user_id',
        'task_id'
    ];

}
