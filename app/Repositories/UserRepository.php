<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {

    /**
     * Get user
     *
     * @param $value
     * @param string $column
     * @param bool $not_found_fail
     * @return mixed
     */
    public function getUser($value, $column = 'id', $not_found_fail = true)
    {
        $query = User::where($column, $value);

        if($not_found_fail) {
            $user = $query->firstOrFail();
        } else {
            $user = $query->first();
        }

        return $user;
    }


    /**
     * Create user
     *
     * @param array $request
     * @return mixed
     */
    public function createUser(array $request)
    {
        if (isset($request['password'])) {
            $request['password_hash'] = Hash::make($request['password']);
            unset($request['password']);
        }

        $request['token'] = str_random('16') . '.' . md5(uniqid($request['email'], true));
        $request['auth_key'] = str_random('16') . '.' . md5(uniqid($request['email'], true));

        $user = User::create($request);
        return $user;
    }

}