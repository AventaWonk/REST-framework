<?php
namespace general;

/**
* 
*/
class ResponseSuccess
{
	public static function get($object, $status = 200) 
	{
		http_response_code($status);
		if (isset($object)) {
			return [
				'response' => $object
			];
		}
		return [
			'code' => 1
		];
	}
}

/**
* 
*/
class ResponseError
{
	public static function get($message, $code = 0, $status = 400) 
	{
		http_response_code($status);
		return [
			'error' => [
				'code' => $code,
				'message' => $message
			]
		];
	}
}

/**
* 
*/
// class Response
// {
// 	// public $response;

// 	// function __construct($response)
// 	// {
// 	// 	$this->response = $response;
// 	// }

// 	// public static function send($object) 
// 	// {
// 	// 	// if (gettype($object) == 'object' && get_class($object) == "Exception") {
// 	// 	// 	$response = ResponseError::get($object->getMessage()) ;
// 	// 	// } else {
// 	// 	// 	$response = ResponseSuccess::get($object);
// 	// 	// }	
// 	// 	// $response = ResponseSuccess::get($object->response);
// 	// 	echo json_encode($object);
// 	// }
// }
