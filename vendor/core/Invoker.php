<?php
namespace vendor\core;

/**
 * Invoker class
 */
class Invoker
{
  protected $className;

  function __construct(string $className)
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
    if ($params) { return $params; }
    $ReflectionMethod =  new \ReflectionMethod($this->className, $methodName);
    $params = $ReflectionMethod->getParameters();

    $handledParams = [];
    foreach ($params as $param) {
      if (!$param->isDefaultValueAvailable()) {
        $handledParams[] = $param->name;
      }
    }
    $cacher->saveData($handledParams);

    return $handledParams;
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
