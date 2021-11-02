<?php

namespace App\Repositories;


use App\Models\Station;
use App\Models\User;
use App\Models\UserStation;

class StationRepository {

    /**
     * Get all valid and active stations with their respective sensors.
     * @return array
     */
    public function getStations(User $auth_user) {
        $user_stations = UserStation::select('station')
            ->where('user', $auth_user->id)
            ->where('active', 1)
            ->whereRaw('NOW() BETWEEN date_valid_from AND date_valid_to')->pluck('station')->all();

        $stations = Station::where('id', $user_stations)->where('active', 1)->get();

        return $stations;
    }

}