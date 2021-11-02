<?php

namespace App\Http\Responses\API;

use App\Models\User;

class UserTransformer {

    /**
     * Return user profile
     *
     * @param User $user
     * @return array
     */
    public function profile(User $user)
    {
        return [
            'id' => $user->id,
            'auth_key' => $user->auth_key,
            'email' => $user->email,
            'zip' => $user->zip,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'county_province' => $user->county_province,
            'city' => $user->city,
            'phone' => $user->phone,
            'country' => $user->country,
            'address' => $user->address,
            'subscribed' => $user->subscribed ? true : false
        ];
    }

}