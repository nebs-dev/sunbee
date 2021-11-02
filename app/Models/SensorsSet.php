<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorsSet extends Model
{
    
	protected $table = 'sensors_sets';

	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
	protected $fillable = [
		'name',
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
	 * Station relation
	 *
	 * * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function stations()
	{
		return $this->hasMany('App\Station');
	}

	/**
	 * Sensor relation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
	 */
	public function sensors()
	{
		return $this->belongsToMany('App\Sensor', 'sensors_sets_has_sensors', 'sensors_set', 'sensor');
	}

}
