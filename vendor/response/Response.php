<?php
namespace vendor\response;

/**
*
*/
class Response
{

	const SUCCESS = true;
  const ERROR = false;
  const SUCCESS_DEFAULT_STATUS = 200;
  const ERROR_DEFAULT_STATUS = 400;

  protected $object;
  protected $status

  public function set($object, int $status)
  {
  	$this->object = $object;
  	$this->status = $status
  }

  public function get()
  {
  	return [
			'response' => $this->$object,
			'status' => $this->status,
		];
  }

}

/**
*
*/
class ResponseSuccess extends Response
{

	function __construct($object, $status = 200)
	{
		if (isset($object)) {
			$this->object = [
				'response' => $object
			];
		} else {
			$this->object = [
				'code' => $object
			];
		}

		$this->status = $status;
	}

}

/**
*
*/
class ResponseError extends Response
{

	function __construct($message, $code = 0, $status = 400)
	{
		$this->object = [
			'error' => [
				'code' => $code,
				'message' => $message
			];
		];

		$this->status = $status;
	}

}

/**
*
*/
class ResponseSender
{

  public function send($response)
  {

  }

}
