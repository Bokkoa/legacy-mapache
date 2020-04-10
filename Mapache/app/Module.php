<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'Module_Name';

    protected $fillable = [
        'Module_Name', 'Directions', 'Coordinates', 'Image_Path', 
    ];

    public function subjects()
    {
        return $this->hasMany('App\Subject', 'FK_Module', 'Module_Name');
    }

    public function instances()
    {
        return $this->hasMany('App\Instance', 'FK_Module', 'Module_Name');
    }
}
