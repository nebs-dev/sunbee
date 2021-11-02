<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorMeasurement extends Model
{
    
	protected $table = 'sensors_measurements';

	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
	protected $fillable = [
		'station_measurement',
		'sensor',
		'value'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 * @var array
	 */
	protected $hidden = [
		'date_created', 'date_modified'
	];



	/**
	 * Sensor relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function sensorObj()
	{
		return $this->belongsTo('App\Models\Sensor', 'sensor');
	}

	/**
	 * StationMeasurement relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function stationMeasurement()
	{
		return $this->belongsTo('App\Models\StationMeasurement', 'station_measurement');
	}


	public function userSensors() {
		$station_measurement = StationMeasurement::where('id', $this->station_measurement)->first();
		return UserSensor::where('station', $station_measurement->station)->get();
	}

}
