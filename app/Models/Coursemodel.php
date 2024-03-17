<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursemodel extends Model
{

    use HasFactory;
    protected $fillable = [
        'code',
        'nortionlHours',
        'name',
        'type',
        'description',
        'status',
        'createdby',
    ];
    public function batches() {
        return $this->hasMany(Batch::class);
    }

    public function modulesubjects() {
        return $this->hasMany(coursesubjects::class);
    }
}
