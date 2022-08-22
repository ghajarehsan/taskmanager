<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departmentlevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'ticket_level_id',
        'user_id'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class,'department_level_id');
    }

}
