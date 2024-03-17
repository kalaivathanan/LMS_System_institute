<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class batchsubject extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'hours', 'courseid', 'batchid'];

    public function course()
    {
        return $this->belongsTo(Coursemodel::class, 'courseid');
    }
    public function people()
    {
        return $this->belongsTo(Person::class, 'teacherid');
    }
    public function batch()
    {
        return $this->belongsTo(batch::class, 'batchid');
    }
    public function subject() {
        return $this->hasMany(acadamiccalender::class);
    }
}
