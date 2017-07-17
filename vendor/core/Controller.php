<?php
namespace vendor\core;

use vendor\response\Response;

/**
* Controller
*/
class Controller
{
  const SUCCESS = true;
  const ERROR = false;
  const DONE = 1;

  public function JSON($object = self::DONE, $result = self::SUCCESS)
  {
    header("Content-Type: application/json");

    switch ($result) {
      case self::SUCCESS:
        $r = new Response($object);
        $response = $r->success();
        break;

      case self::ERROR:

        break;

      default:
        $r = new Response($object);
        $response = $r->success();
        break;
    }

    return json_encode($response);
  }

  /**
  * @TODO
  */
  // public function XML($object, $result = self::SUCCESS)
  // {
  //   return new XMLResponse($object, $result);
  // }
  //
  // public function View($object, $result = self::SUCCESS)
  // {
  //   return new ViewResponse($object, $result);
  // }

}
