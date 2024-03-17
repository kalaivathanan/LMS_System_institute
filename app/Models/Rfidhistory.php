<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfidhistory extends Model
{
    use HasFactory;
    protected $table = 'rfidhistory';

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
