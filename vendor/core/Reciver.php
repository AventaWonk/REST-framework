<?php
namespace  vendor\core;

/**
 * Reciver class
 */
class Reciver
{
  private $requestMethod;
  private $controllerName;
  private $methodName;

  /**
   * @param string $rpString
   * @param string $delimiter
   */
  function __construct($rpString = 'method', $delimiter = '/')
  {
    $this->requestMethod = $_SERVER['REQUEST_METHOD'];

    $requestParams = $_REQUEST[$rpString];
    if (!empty($requestParams)) {
      $pieces = explode($delimiter, $requestParams);
      $this->controllerName = mb_convert_case($pieces[0], MB_CASE_TITLE);
      $this->methodName = $pieces[1];
    } else {
      throw new \Exception("Bad request", 1);
    }
  }

  /**
   * @return string
   */
  public function getControllerName()
  {
    return $this->controllerName;
  }

  /**
   * @return string
   */
  public function getMethodName()
  {
    return $this->methodName;
  }

  /**
   * @return string
   */
  public function getRequestMethod()
  {
    return $this->requestMethod;
  }
}
