<?php

namespace App\Http\Traits;

use App\Exceptions\ApiException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseHelper
{
    public function fail($message = null, int $status = 500, int $error_code = 0)
    {
        $context = [
            'success' => false,
            'error' => [
                'code' => $error_code,
                'message' => $message,
                //'reason' => $message,
            ],
        ];
        return response()->json($context, $status);
    }

    /**
     * Success response
     *
     * @param $result
     * @param bool $prettyPrint
     * @return JsonResponse
     */
    protected function success($result = [], bool $prettyPrint = true): JsonResponse
    {
        $response = ['success' => true];
        if (!empty($result)) {
            $response['result'] = $result;
        }
        return response()->json($response, 200, [], $prettyPrint ? JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION : 0);
    }

    /**
     * Failure response
     *
     * @param string $message
     * @param int $status
     * @param \Throwable|null $previous The previous exception used for the exception chaining.
     * @return Response
     * @throws ApiException
     */
    protected function failure(string $message = '', int $status = 500, $previous = null): Response
    {
        throw new ApiException($message, $status, $previous);
    }
}