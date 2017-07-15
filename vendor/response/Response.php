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

  const SUCCESS_DEFAULT_CODE = 1;

  protected $object;
  protected $message;
  protected $status;
  protected $code;

  function __construct($object = self::SUCCESS_DEFAULT_CODE)
  {
  	$this->object = $object;
  }

  public function success()
  {
		return [
		  'response' => $this->object
		];
  }

  public function failure()
  {
    return [
		  'error' => [
			  'code' => $this->code,
				'message' => $this->message
			]
		];
  }

  public function setMessage($message)
  {
    $this->message = $message;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function setCode($code)
  {
    $this->code = $code;
  }

  public static function send($result) {
    if ($result) {
      echo $result;
    } else {
      throw new \Exception("Method was not configured correctly", 1);
    }
  }
}
