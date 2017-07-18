<?php
namespace vendor\core;

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

  /**
   * @param string $methodName
   * @return ReflectionParameter[]
   */
  public function getMethodParams($methodName)
  {
    $cacher = new Cacher($methodName);
    $params = $cacher->getData();
    if($params)
      return $params;

    $ReflectionMethod =  new \ReflectionMethod($this->className, $methodName);
    $params = $ReflectionMethod->getParameters();
    $params2 = [];
    foreach ($params as $param) {
      if (!$param->isDefaultValueAvailable()) {
        $params2[] = $param->name;
      }
    }
    $cacher->saveData($params2);

    return $params2;
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
