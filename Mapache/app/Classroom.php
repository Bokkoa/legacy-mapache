<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $primaryKey = 'Classroom_ID';

    protected $fillable = [
        'Name', 
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_classroom');
    }
    
}
