<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = 'Service_ID';

    protected $fillable = [
        'Name', 'FK_Instance', 'Description', 
    ];

    function service() {
        return $this->belongsTo('App\Instance');
    }
}
