<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    public function getuser()
    {
        return $this->belongsTo(User::class,'uid', 'id');
    }
    protected $fillable = [
        'fullname', 'ininame', 'nic', 'paddress', 'raddress',
        'hphone', 'mphone', 'wphone', 'email', 'batchid','dob','gender',
    ];
}
