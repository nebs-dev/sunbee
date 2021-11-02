<?php

namespace App\Http\Controllers\API;

use App\Http\Responses\API\StationTransformer;
use App\Models\SensorMeasurement;
use App\Repositories\StationRepository;


class StationsController extends BaseController
{

    /**
     * @var StationTransformer
     */
    private $station_transformer;

    /**
     * @var StationRepository
     */
    private $station_repo;

    /**
     * @param StationRepository $station_repo
     * @param StationTransformer $station_transformer
     */
    public function __construct(StationRepository $station_repo, StationTransformer $station_transformer) {
        $this->station_repo = $station_repo;
        $this->station_transformer = $station_transformer;
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getStations() {
        # Get all valid and active stations with their respective sensors.
        $stations = $this->station_repo->getStations(auth()->user());

        return $this->buildJsonResponse($this->station_transformer->listWithMeasurements($stations));
    }


    public function getHistory($uid = '') {

    }

}
