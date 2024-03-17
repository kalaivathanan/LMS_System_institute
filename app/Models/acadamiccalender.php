<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acadamiccalender extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'subject',
        'batch',
        'lessoncontent',
        'start',
        'end',
        'slotsize',
        'uid',
        'status',
        'color',
        'teacherid',

    ];
    public function getsubject()
    {
        return $this->belongsTo(batchsubject::class, 'subject', 'id');
    }
    public function getTeacher()
    {
        return $this->belongsTo(subjectteacher::class, 'teacherid', 'id');
    }

}
