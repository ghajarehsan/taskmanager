<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'seen',
        'user_id',
        'department_id'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function ticketusers()
    {
        return $this->hasMany(Ticketuser::class);
    }


}
