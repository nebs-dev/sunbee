<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model {

    protected $table = 'sensors';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'show_to_user',
        'threshold',
        'label',
        'order',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'date_created', 'date_modified'
    ];


    /**
     * User relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'users_sensors', 'sensor', 'user');
    }

    /**
     * SensorMeasurement relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function sensorMeasurements()
    {
        return $this->hasMany('App\Models\SensorMeasurement');
    }

    /**
     * SensorsSet relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function sensorsSets()
    {
        return $this->belongsToMany('App\Models\SensorsSet', 'sensors_sets_has_sensors', 'sensor', 'sensors_set');
    }

}
