<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorPju extends Model
{
    //
    protected $table = 'sensor_pju';
    protected $fillable = [
        'voltage',
        'lamp_state',
        'counter',
        'frequency',
        'power_factor',
        'datetime',
        'brightness',
        'current',
        'energy',
        'error_state',
        'node_id',
        'power',
        'temperature',
    ];

}
