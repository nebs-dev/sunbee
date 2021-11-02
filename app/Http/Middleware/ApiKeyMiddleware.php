<?php

namespace App\Http\Middleware;

use App\Traits\API\ResponseBuilderTrait;
use Closure;

class ApiKeyMiddleware
{
    use ResponseBuilderTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated
        $auth_header = $request->header('X-Api-Key');

        // Check if authentication header is provided
        if(empty($auth_header) || !$this->checkApiKey($auth_header)) {
            return $this->buildErrorResponse('Nevažeći API ključ.', 401);
        }

        return $next($request);
    }


    private function checkApiKey($api_key) {
        return $api_key == '9p7Kgi9QLG6u8gTAkJoZrCZiaiVcJE7p';
    }
}
