<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batch';
    use HasFactory;
    protected $fillable = [
        'courseid',
        'fee',
        'startdate',
        'installment',
        'daysperweek',
        'duration',
        'public',
        'basepayment',
        'regFee',
        'batchstatus',
        'center',
        'enddate',
        'createdby',

    ];
    public function course()
    {
        return $this->belongsTo(Coursemodel::class, 'realcourseid', 'id');
    }
    public function modulesubjects() {
        return $this->hasMany(coursesubjects::class);
    }
}

