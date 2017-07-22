<?php
namespace vendor\core;

use vendor\response\Response;

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
      $appSettings = new Settings($settings);

      $headers = new Headers($appSettings);
      $headers->sendHeaders();

			$receiver = new Receiver();
			$className = self::APP_DIR .  DIRECTORY_SEPARATOR . self::CONTROLLERS_DIR . DIRECTORY_SEPARATOR . $receiver->getControllerName() . "Controller";
			$methodName = $receiver->getMethodName();

      $invoker = new Invoker($className);
      $requiredParams = $invoker->getMethodParams($methodName);

      $receivedParams =  $receiver->getReceivedParams($requiredParams);

      $result = $invoker->invoke($methodName, $receivedParams);

      Response::send($result);
		} catch (\Exception $e) {
		  Response::send($e);
		}
	}
}
