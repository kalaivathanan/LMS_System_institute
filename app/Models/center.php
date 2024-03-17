<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class center extends Model
{
    use HasFactory;
    protected $fillable = [
        'centername',
        'address',
        'phone',
        'fax',
        'email',
        'status',
        'managerid',
    ];
}
