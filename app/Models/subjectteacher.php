<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjectteacher extends Model
{
    protected $table = 'subjectteacher';
    use HasFactory;
    public function batch()
    {
        return $this->belongsTo(batch::class,'courseid', 'id');
    }
    public function subject()
    {
        return $this->belongsTo(batchsubject::class,'subjectid', 'id');
    }
    public function teacher()
    {
        return $this->belongsTo(Person::class,'teacherid', 'id');
    }
}
