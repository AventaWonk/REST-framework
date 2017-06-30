<?php
namespace vendor\core;

/**
* Controller
*/
class Controller
{
  const SUCCESS = true;
  const ERROR = false;

  public function JSON($object, $result = self::SUCCESS)
  {
    header("Content-Type: application/json");

    switch ($result) {
      case self::SUCCESS:
        $result = ResponseSuccess::get($object);
        break;

      case self::ERROR:
        $result = ResponseError::get($object);
        break;

      default:
        $result = ResponseError::get($object);
        break;
    }

    return json_encode($result);
  }

  public function XML($object, $result = self::SUCCESS)
  {
    return new XMLResponse($object, $result);
  }

  public function View($object, $result = self::SUCCESS)
  {
    return new ViewResponse($object, $result);
  }

}
