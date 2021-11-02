<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    
	protected $table = 'notifications';

	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
	protected $fillable = [
		'level',
		'content',
		'user',
		'global',
		'sent',
		'uid',
		'stations_measurement'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 * @var array
	 */
	protected $hidden = [
		'date_valid_from', 'date_valid_to', 'date_created', 'date_modified'
	];


	/**
	 * User relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * StationMeasurement relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function stationMeasurement()
	{
		return $this->belongsTo('App\StationMeasurement');
	}

}
