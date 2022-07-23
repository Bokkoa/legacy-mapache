<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{   
    protected $primaryKey = 'Instance_ID';

    protected $fillable = [
        'Name', 'FK_Module', 'Coordinates', 'Image_Path', 
    ];
    function module() {
        return $this->belongsTo('App\Module');
    }
}
