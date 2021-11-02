<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Responses\API\UserTransformer;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends BaseController {

    /**
     * @var UserTransformer
     */
    private $user_transformer;

    /**
     * @var UserRepository
     */
    private $user_repo;

    public function __construct(UserTransformer $user_transformer, UserRepository $user_repo) {
        $this->user_transformer = $user_transformer;
        $this->user_repo = $user_repo;
    }


    /**
     * Login user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request)
    {
        if (!isset($request['email']) || !isset($request['password'])) {
            return $this->buildErrorResponse('Bad Request', 400);
        }

        $user = User::where(['email' => $request['email'], 'active' => 1])->first();

        if (!empty($user)) {
            if ($user->validatePassword($request['password'])) {
                $user->logged_in = true;
                $user->date_logged = Carbon::now();
                if ($user->save()) {
                    return $this->buildJsonResponse($this->user_transformer->profile($user));
                }
            }
        }

        return $this->buildErrorResponse('Korisnik nije pronađen.', 404);
    }


    /**
     * @param RegisterRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(RegisterRequest $request) {
        if (User::where('email', $request->email)) {
            $user = $this->user_repo->createUser($request->all());

            if ($user) {
                return $this->buildJsonResponse($this->user_transformer->profile($user));

            } else {
                return $this->buildErrorResponse('Korisnik nije kreiran.', 500);
            }
        }

        return $this->buildErrorResponse('Ovaj korisnik vec postoji.', 500);
    }

}
