<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StationMeasurement extends Model {

    protected $table = 'stations_measurements';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'station',
        'note',
        'confirmed',
        'checked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'date_created', 'date_modified'
    ];


    /**
     * Station relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function stations()
    {
        return $this->belongsTo('App\Station');
    }

    /**
     * SensorMeasurement relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function sensorMeasurements()
    {
        return $this->hasMany('App\SensorMeasurement');
    }

    /**
     * Notification relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

}
