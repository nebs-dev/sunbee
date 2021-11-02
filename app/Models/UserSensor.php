<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSensor extends Model {

    protected $table = 'users_sensors';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user',
        'station',
        'sensor',
        'type',
        'value',
        'label'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'date_created', 'date_modified'
    ];

}
