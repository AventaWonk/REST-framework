<?php

	/**
	* 
	*/
	class ResponseSuccess
	{
		public static function get($object, $status = 200) {
			http_response_code($status);

			if(isset($object)) {
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
		public static function get($message, $code = 0, $status = 400) {
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
	class Response
	{

		public static function send($object) {

			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: *");
			header("Content-Type: application/json");

			if(gettype($object) == 'object' && get_class($object) == "Exception") {
				$response = ResponseError::get($object->getMessage()) ;
			} else {
				$response = ResponseSuccess::get($object);
			}	

			

			echo json_encode($response);
		}
	}
