<?php
namespace App\Parser;

use App\Http\Resources\BookResource;

class JsonParser 
{
    public function jsonparse($response, string $status, int $status_code)
    {
        return response()->json([
            'status_code' => $status_code,
            'status' => $status,
            'data' =>  $response
        ], $status_code);
    }
}