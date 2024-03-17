<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'personid', 'catogary', 'ispresent', 'lessonid', 'intime','rfid',
    ];
    public function lesson()
    {
        return $this->belongsTo(acadamiccalender::class, 'lessonid');
    }
    public function getStudent()
    {
        return $this->belongsTo(Applicant::class, 'personid');
    }

    public function getteacher()
    {
        return $this->belongsTo(Person::class, 'personid');
    }
}
