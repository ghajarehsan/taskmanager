<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticketlevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'ticket_id',
        'department_id'
    ];

    public function departmentLevels()
    {
        return $this->hasMany(Departmentlevel::class,'ticket_level_id');
    }

}
