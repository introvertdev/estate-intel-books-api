<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\BookResource;

trait ApiResponser{

    protected function fetchSuccessResponse($data, $message = null, $code = 200)
	{
		$collection = BookResource::collection($data);
		return response()->json([
			'status_code' => $code,
			'status'=> 'success', 
			//'message' => $message, 
			'data' => $collection->forget('id')
		], $code);
	}

	protected function externalFetchSuccessResponse($data, $message = null, $code = 200)
	{
		if(empty($data)){
			return response()->json([
				'status_code' => 404,
				'status' => 'not found',
				'data' =>  $data
        	], $code);
		}else{
			return response()->json([
				'status_code' => $code,
				'status' => 'success',
				'data' =>  $data
        	], $code);
		}
	}

	protected function successResponse($data, $message = null, $code = 200)
	{
		if(is_null($message) && $code != 201){
			return response()->json([
				'status_code' => $code,
				'status'=> 'success', 
				'data' => new BookResource($data)
			], $code);
		}elseif($code == 204){
			return response()->json([
				'status_code' => $code,
				'status'=> 'success', 
				'message' => $message, 
				'data' => array()
			], 200);
		}elseif($code == 201){
			return response()->json([
				'status_code' => $code,
				'status'=> 'success', 
				'data' => array(
					'book'	=> new BookResource($data)
				)
			], 201);
		}else{
			return response()->json([
				'status_code' => $code,
				'status'=> 'success', 
				'message' => $message, 
				'data' => new BookResource($data)
			], $code);
		}
		
	}

	protected function errorResponse($message = null, $code)
	{
		return response()->json([
			'status_code' => $code,
			'status'=>'not found',
			'message' => $message,
			'data' => array()
		], $code);
	}

}