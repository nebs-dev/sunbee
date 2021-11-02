<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model {

    protected $table = 'users_settings';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user',
        'type',
        'label',
        'name',
        'value',
        'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'date_created', 'date_modified'
    ];

}
