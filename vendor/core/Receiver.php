<?php
namespace  vendor\core;

/**
 * Receiver class
 */
class Receiver
{
  private $requestMethod;
  private $controllerName;
  private $methodName;

  /**
   * @param string $paramName
   * @param string $delimiter
   */
  function __construct($paramName = 'method', $delimiter = '/')
  {
    $this->requestMethod = $_SERVER['REQUEST_METHOD'];

    $requestParams = $_REQUEST[$paramName];
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
   * @param ReflectionParameter[] $requiredParams
   * @return array
   */
  public function getReceivedParams($requiredParams)
  {
    $receivedParams = [];
    foreach ($requiredParams as $requiredParam) {
      if (isset($_REQUEST[$requiredParam->name])) {
        $receivedParams[] = $_REQUEST[$requiredParam->name];
      } else if (!$requiredParam->isDefaultValueAvailable()) {
        throw new \Exception("Error Processing Request", 1);
      }
    }
    return $receivedParams;
  }

  /**
   * @return string
   */
  public function getRequestMethod()
  {
    return $this->requestMethod;
  }
}
