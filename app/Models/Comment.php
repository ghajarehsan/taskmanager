<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function commentable()
    {
        return $this->morphTo();
    }

    protected $fillable = [
        'text',
        'status',
        'seen',
        'commentable_id',
        'commentable_type'
    ];

}
