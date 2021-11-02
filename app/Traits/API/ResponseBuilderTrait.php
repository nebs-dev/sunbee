<?php

namespace App\Traits\API;

trait ResponseBuilderTrait {

    private $names = [
        200 => 'Success',
        401 => 'Unauthorized',
        400 => 'Bad Request',
        404 => 'Not Found',
        500 => 'Internal Server Error'
    ];


    /**
     * Build JSON response object
     *
     * @param $object
     * @param null $key
     * @param int $code
     * @param array $extra
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function buildJsonResponse($object, $key = NULL, $code = 200, $extra = [], $headers = [])
    {

        if($key == NULL) {

            if(is_object($object)){
                $object = $object->toArray();
            }

            $json_response = response(array_merge($object, $extra), $code, $headers);

            return $json_response;

        }
        else{
            return response(array_merge([$key => $object], $extra), $code, $headers);

        }
    }

    /**
     * Build an error object to return in json format
     *
     * @param $key
     * @param int $code
     * @param array $extra
     * @param null $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function buildErrorResponse($key, $code = 400, $extra = [], $exception = null)
    {
        return $this->buildResponse($key, $code, $extra, $exception);
    }

    /**
     * Build JSON response
     *
     * @param $key
     * @param int $code
     * @param array $extra
     * @param null $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function buildResponse($key, $code = 400, $extra = [], $exception = null)
    {

        $response = [
            'name' => $this->names[$code],
            'message' => $key,
            'code' => $code,
            'status' => $code
        ];


        if(! empty($exception)) {
            $response['exception'] = [
                'localized_message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'exception_name' => get_class($exception)
            ];
        }

        return response(array_merge($response, $extra), $code);
    }

}