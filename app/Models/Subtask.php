<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory;

    protected $fillable=[
        'subject',
        'status',
        'priority',
        'deadline',
        'privilege',
        'seen',
        'worklog',
        'ticket_id',
        'user_id',
        'task_id'
    ];

}
