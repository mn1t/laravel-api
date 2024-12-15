<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Request;
use App\Http\Traits\ResponseHelper;


class ApiException extends Exception
{
    use ResponseHelper;

    public function report(){
        return false;
    }    

    public function render($message){
       
        $response = [
            'success' => false,
            'error' => [
                'code' => $this->code,
                'message' => $this->message,
            ]
        ];

        return response()->json($response, $this->code, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION);
    }
}
