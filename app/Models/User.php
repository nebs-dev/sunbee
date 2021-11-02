<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable {

    use Notifiable;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'email',
        'password_hash',
        'token',
        'auth_key',
        'first_name',
        'last_name',
        'phone',
        'country',
        'country_province',
        'city',
        'zip',
        'address',
        'gcm'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password_hash', 'token', 'role', 'gcm', 'active', 'logged_in', 'date_logged', 'date_created', 'date_modified'
    ];


    /**
     * Sensors relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function sensors()
    {
        return $this->belongsToMany('App\Sensor', 'users_sensors', 'user', 'sensor');
    }

    /**
     * Stations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function stations()
    {
        return $this->belongsToMany('App\Station', 'users_stations', 'user', 'station');
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


    /**
     * Validate user password
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        if(Hash::check($password, $this->password_hash)) {
            return true;
        }

        return false;
    }

}
