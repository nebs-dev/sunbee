<?php

namespace App\Http\Controllers\API;

use App\Http\Responses\API\UserTransformer;
use Illuminate\Http\Request;

class UsersController extends BaseController {

    /**
     * @var UserTransformer
     */
    private $user_transformer;

    /**
     * @param UserTransformer $user_transformer
     */
    public function __construct(UserTransformer $user_transformer)
    {
        $this->user_transformer = $user_transformer;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUser()
    {
        return $this->buildJsonResponse($this->user_transformer->profile(auth()->user()));
    }

}
