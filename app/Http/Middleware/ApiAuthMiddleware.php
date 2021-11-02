<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use App\Traits\API\ResponseBuilderTrait;
use Closure;

class ApiAuthMiddleware {

    use ResponseBuilderTrait;

    private $user;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated
        $auth_header = $request->header('X-Authorization');

        // Check if authentication header is provided
        if(empty($auth_header) || !$this->authCheck($auth_header)) {
            return $this->buildErrorResponse('Nevažeća autorizacija.', 401);
        }

        // Login user
        auth()->login($this->user);

        return $next($request);
    }


    /**
     * Check user authentication
     *
     * @param $api_token
     * @return bool
     */
    private function authCheck($api_token)
    {
        // Get user
        $user = (new UserRepository())->getUser($api_token, 'auth_key', false);

        // Check if user exists
        if(!empty($user)) {

            // User is authenticated
            $this->user = $user;

            // Proceed to next request
            return true;
        }

        return false;
    }

}
