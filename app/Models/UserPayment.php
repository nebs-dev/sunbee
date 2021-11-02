<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model {

    protected $table = 'users_payments';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user',
        'station',
        'payment_id',
        'transaction_id',
        'amount',
        'card_type',
        'card_holder'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'date_created', 'date_modified'
    ];

}
