<?php

namespace app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\API\ResponseBuilderTrait;

class BaseController extends Controller {

    use ResponseBuilderTrait;

}