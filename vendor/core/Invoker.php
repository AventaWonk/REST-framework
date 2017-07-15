<?php
namespace vendor\core;

use Exception;
use ReflectionMethod;

/**
 * Invoker class
 */
class Invoker
{
  protected $className;

  function __construct($className = false)
  {
    $this->className = $className;
  }

  public function getMethodParams($methodName)
  {
    $params = [];
    $ReflectionMethod =  new ReflectionMethod($this->className, $methodName);
    foreach ($ReflectionMethod->getParameters() as $param) {
      $params[] = $param->name;
    }

    return $params;
  }

  public function Invoke($methodName, $receivedParams)
  {
    $controller = new $this->className();
    $result = $controller->$methodName(...$receivedParams);

    return $result;
  }

  public function setClassName($className)
  {
    $this->className = $className;
  }

  public function getClassName()
  {
    return $this->className;
  }

}
