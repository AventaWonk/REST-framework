<?php
namespace vendor\core;

use ReflectionMethod;
use Exception;
use vendor\core\ClassTools;

/**
* Router class
*/
class Router
{
  const GET = 'GET';
	const POST = 'POST';
	const ALLOW_PUBLIC_ACCESS = 1;
	const DENY_PUBLIC_ACCESS = 0;

  const APP_DIR = 'app';
	const CONTROLLERS_DIR = 'controllers';
  const MODELS_DIR = 'models';
  const SETTINGS_DIR = 'settings';

	public static function start($access = 0)
	{
		try {
			if ($access == self::ALLOW_PUBLIC_ACCESS) {
				header("Access-Control-Allow-Origin: *");
			}
			// header("Access-Control-Allow-Methods: *");


			$method = $_SERVER['REQUEST_METHOD'];

      switch ($method) {
        case self::GET:
          if (isset($_GET['method'])) {
            $pieces = explode('/', $_GET['method']);
          } else {
            throw new Exception("Bad GET request", 1);
          }
          break;

        case self::POST:
          if (isset($_POST['method'])) {
            $pieces = explode('/', $_POST['method']);
          } else {
            throw new Exception("Bad POST request", 1);
          }
          break;

        default:
          throw new Exception("Bad request", 1);
          break;
      }

			$className = self::APP_DIR .  DIRECTORY_SEPARATOR . self::CONTROLLERS_DIR . DIRECTORY_SEPARATOR . mb_convert_case($pieces[0], MB_CASE_TITLE) . "Controller";
			$methodName = $pieces[1];

      $ct = new ClassTools($className, $methodName);
			$methodParams = $ct->getMethodParams();

      $receivedParams = [];
			if ($method == self::GET) {
				foreach ($args as $value) {
					if(!isset($_GET[$value])){
						throw new Exception("Has not all params", 1);
					}
					$params[] = $_GET[$value];
				}
			} else {
				foreach ($args as $value) {
					if (!isset($_POST[$value])){
						throw new Exception("Has not all params", 1);
					}
					$params[] = $_POST[$value];
				}
			}

			$controller = new $className();
			$result = $controller->$methodName(...$params);

      if ($result) {
        echo $result;
      } else {
        throw new Exception("Method {$className} was not configured correctly", 1);
      }

		} catch (Exception $e) {
		  echo $e;
		}
	}
}
