<?php

namespace App\Models;

use App\Services\Traits\Permission\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasPermissions;

    protected $fillable = [
        'name',
        'persian_name'
    ];

}
