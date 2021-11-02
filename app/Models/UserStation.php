<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStation extends Model {

    protected $table = 'users_stations';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user',
        'station',
        'alias',
        'location',
        'active',
        'date_valid_from',
        'date_valid_to'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'date_created', 'date_modified'
    ];

}
