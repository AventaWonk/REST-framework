<?php
namespace vendor\core;

use vendor\core\ClassTools;

/**
* Router class
*/
class Router
{
  const APP_DIR = 'app';
	const CONTROLLERS_DIR = 'controllers';
  const MODELS_DIR = 'models';
  const SETTINGS_DIR = 'settings';

  /**
  * @static
  * @param array $settings
  */
	public static function start($settings = [])
	{
		try {
      $appSettings = new fSettings($settings);

      $headers = new Headers();
      $headers->setHeaders($appSettings);
      $headers->sendHeaders();

			$reciver = new Reciver();
			$className = self::APP_DIR .  DIRECTORY_SEPARATOR . self::CONTROLLERS_DIR . DIRECTORY_SEPARATOR . $reciver->getControllerName() . "Controller";
			$methodName = $reciver->getMethodName();

      $ct = new ClassTools($className);
			$methodParams = $ct->getMethodParams($methodName);
      $receivedValues = $ct->getReceivedParams($methodParams);

			$controller = new $className();
			$result = $controller->$methodName(...$receivedValues);

      if ($result) {
        echo $result;
      } else {
        throw new \Exception("Method {$className} was not configured correctly", 1);
      }

		} catch (\Exception $e) {
		  echo $e;
		}
	}
}
