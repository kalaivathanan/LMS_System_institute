<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempRfid extends Model
{
    use HasFactory;
    protected $table = 'temprfid';

    protected $fillable = [
        'applicantid',
        'rfid',
        'name',
        'status',
        'regtime',
        'accepttime',
        'deltime',
        'uid',
        'createdby',
    ];
}
