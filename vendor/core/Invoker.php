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

  /**
   * @param string $methodName
   * @return ReflectionParameter[]
   */
  public function getMethodParams($methodName)
  {
    // $cacheFileName = $methodName . '.tmp';
    // if (file_exists($cacheFileName)) {
    //   return file($cacheFileName, FILE_IGNORE_NEW_LINES);
    // }
    // $params = [];
    // $ReflectionMethod =  new ReflectionMethod($this->className, $methodName);
    // foreach ($ReflectionMethod->getParameters() as $param) {
    //   $params[] = $param->name;
    // }
    //
    // $c = count($params);
    // $f = fopen($cacheFileName, 'w');
    // for ($i = 0; $i < $c; $i++) {
    //   fwrite($fp, $params[$i]);
    //   fwrite($fp, "\n");
    // }
    //
    // return $params;
    $ReflectionMethod =  new ReflectionMethod($this->className, $methodName);
    
    return $ReflectionMethod->getParameters();
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
