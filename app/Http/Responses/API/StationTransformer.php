<?php

namespace App\Http\Responses\API;


use App\Models\Station;
use App\Repositories\SensorMeasurementRepository;

class StationTransformer {

    public function listWithMeasurements($stations)
    {
        $data = [];

        foreach ($stations as $station) {
            $data[$station->uid]['alias'] = $station->userStation->alias;
            $data[$station->uid]['geo']['lat'] = '';
            $data[$station->uid]['geo']['lon'] = '';

            $measurements = (new SensorMeasurementRepository())->getLastSensorMeasurementsForStation($station);

            $stationData = [];
            foreach ($measurements as $measurement) {
                $sensor = $measurement->sensorObj;
                $station_measurement = $measurement->stationMeasurement;

                /**
                 * TODO: wtf???
                 */
                $data[$station->uid]['date_created'] = $station_measurement->date_created;
                $data[$station->uid]['note'] = empty($station_measurement->note) ? '' : $station_measurement->note;

                if($measurement->sensor === $sensor->id) {
                    // Special treatement for lat and lon.
                    if($sensor->name === 'lat' || $sensor->name === 'lon') {
                        $data[$station->uid]['geo'][$sensor->name] = $measurement->value;
                    }

                    // Getting if field is hidden or not.
                    foreach ($measurement->userSensors() as $user_sensor) {
                        if($sensor->id === $user_sensor->sensor) {
                            $visible = (bool)$user_sensor->value;
                            break;
                        }
                    }

                    $stationData[$sensor->name] = [
                        'name' => $sensor->name,
                        'label' => $sensor->label,
                        'value' => $measurement->value,
                        'visible' => isset($visible) ? (bool)$visible : true,
                    ];
                }
            }

            $data[$station->uid]['data'] = $stationData;
        }

        return $data;
    }


    private function getMeasurementsForStation(Station $station)
    {
        $measurements = (new SensorMeasurementRepository())->getLastSensorMeasurementsForStation($station);

        $stationData = [];
        foreach ($measurements as $measurement) {
            $sensor = $measurement->sensorObj;
            $station_measurement = $measurement->stationMeasurement;

            /**
             * TODO: wtf???
             */
            $stationData[$station->uid]['date_created'] = $station_measurement->date_created;
            $stationData[$station->uid]['note'] = empty($station_measurement->note) ? '' : $station_measurement->note;

            if($measurement->sensor === $sensor->id) {
                // Special treatement for lat and lon.
                if($sensor->name === 'lat' || $sensor->name === 'lon') {
                    $stationData[$station->uid]['geo'][$sensor->name] = $measurement->value;
                }

                // Getting if field is hidden or not.
                foreach ($measurement->userSensors() as $user_sensor) {
                    if($sensor->id === $user_sensor->sensor) {
                        $visible = (bool)$user_sensor->value;
                        break;
                    }
                }

                $stationData[$sensor->name] = [
                    'name' => $sensor->name,
                    'label' => $sensor->label,
                    'value' => $measurement->value,
                    'visible' => isset($visible) ? (bool)$visible : true,
                ];
            }
        }

        return $stationData;
    }

}