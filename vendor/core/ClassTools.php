<?php
namespace vendor\core;

use Exception;
use ReflectionMethod;

/**
 *
 */
class ClassTools
{
  protected $className;
  protected $methodName;

  function __construct($className = false, $methodName = false)
  {
    $this->className = $className;
    $this->methodName = $methodName;
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

  public function getReceivedParams($requiredParams)
  {
    $receivedParams = [];
    foreach ($requiredParams as $requiredParam) {
      $receivedParam = $_REQUEST[$requiredParam];
      if ($receivedParam) {
        $receivedParams[] = $receivedParam;
      } else {
        throw new Exception("Error Processing Request", 1);
      }
    }
    return $receivedParams;
  }

  public function setClassName($className)
  {
    $this->className = $className;
  }

  public function getClassName()
  {
    return $this->className;
  }

  public function setMethodName($methodName)
  {
    $this->methodName = $methodName;
  }

  public function getMethodName()
  {
    return $this->$methodName;
  }
}
