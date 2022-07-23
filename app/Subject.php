<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $primaryKey = 'Subject_ID';
    
    protected $fillable = [
        'Name', 'Schedule', 'FK_Module', 
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_subject', 'FK_Subject', 'FK_User');
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'subject_classroom', 'FK_Subject', 'FK_Classrom');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'Module_Name', 'FK_Module');
    }
}
