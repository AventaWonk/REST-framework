<?php
namespace vendor\core;

/**
 *
 */
class ClassTools extends
{
  protected $className;
  protected $methodName

  function __construct($className = false, $methodName = false)
  {
    $this->className = $className;
    $this->methodName = $methodName;
  }

  public function getMethodParams($methodName = false)
  {
    if ($this->methodName || $methodName) {
      if (method_exists($className, $methodName)) {
        $params = [];
        $ReflectionMethod =  new ReflectionMethod($className, $methodName);
        foreach ( $ReflectionMethod->getParameters() as $param) {
          $params[] = $param->name;
        }
        return $params;
      } else {
        throw new Exception("{$methodName} does not exists", 1);
      }
    } else {
      throw new Exception("Bad fun call", 1);
    }
  }

  public function getRecievedParams()
  {
    # code...
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
