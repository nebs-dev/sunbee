<?php

namespace app\Repositories;

use App\Models\Station;
use App\Models\StationMeasurement;
use App\Models\SensorMeasurement;

class SensorMeasurementRepository {

    /**
     * Get last sensor measurements for station.
     *
     * @param Station $station
     * @return mixed
     */
    public function getLastSensorMeasurementsForStation(Station $station) {

        $station_measurement_ids = StationMeasurement::select('id')
            ->where('station', $station->id)
            ->whereRaw("date_created = (SELECT MAX(date_created) FROM stations_measurements WHERE station = {$station->id})")
            ->pluck('id')->all();

        return SensorMeasurement::where('station_measurement', $station_measurement_ids)->get();

    }

}