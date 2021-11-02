<?php

namespace App\Traits\API;

trait ApiFormValidationTrait
{

    /**
     * Override native behaviour for unauthorized response
     *
     * @return array
     */
    public function forbiddenResponse()
    {
        return response([
            'name' => 'Unauthorized',
            'message' => 'Unauthorized',
            'code' => 401,
            'status' => 401
        ], 401);

    }

    /**
     * Override native behaviour of failed validation - return an json message
     *
     * @param array $errors
     * @return array
     */
    public function response(array $errors)
    {
        return response([
            'name' => 'Bad Request',
            'message' => 'Validation failed',
            'code' => 400,
            'status' => 400,
            'validation_errors' => $errors
        ], 400);

    }

}