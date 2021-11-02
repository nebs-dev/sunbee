<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model {

    protected $table = 'stations';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'sensors_set',
        'uid',
        'key',
        'token',
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
        return $this->belongsToMany('App\Models\User', 'users_stations', 'station', 'user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userStation() {
        return $this->hasOne('App\Models\UserStation', 'station');
    }

    /**
     * StationMeasurement relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function stationMeasurements()
    {
        return $this->hasMany('App\Models\StationMeasurement');
    }

    /**
     * SensorsSet relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function sensorsSet()
    {
        return $this->belongsTo('App\Models\SensorsSet');
    }

}
