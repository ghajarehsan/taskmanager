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
        'user_id',
        'department_id',
        'status_id'
    ];

    public function ticketLevels()
    {
        return $this->hasMany(Ticketlevel::class);
    }


}
