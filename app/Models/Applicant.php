<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname', 'ininame', 'nic', 'paddress', 'raddress',
        'hphone', 'mphone', 'wphone', 'email', 'batchid','dob','gender',
    ];

    public function batch()
    {
        return $this->belongsTo(batch::class,'batchid', 'id');
    }
}
