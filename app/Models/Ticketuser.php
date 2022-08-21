<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticketuser extends Model
{
    use HasFactory;

    protected $fillable = [

        'level',
        'ticket_id',
        'user_id',
        'department_id',
        'status_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

}
