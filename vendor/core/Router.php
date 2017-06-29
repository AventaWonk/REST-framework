<?php
namespace vendor\core;

use ReflectionMethod;
use Exception;

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
			$params = [];
			$method;
			$class_name;
			$method_name;
			$file_name;
			$args = [];

			if ($access == self::ALLOW_PUBLIC_ACCESS) {
				header("Access-Control-Allow-Origin: *");
			}

			// header("Access-Control-Allow-Methods: *");
			// header("Content-Type: application/json");

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

			$class_name = self::APP_DIR .  DIRECTORY_SEPARATOR . self::CONTROLLERS_DIR . DIRECTORY_SEPARATOR . mb_convert_case($pieces[0], MB_CASE_TITLE) . "Controller";
			$method_name = $pieces[1];
			$file_name = self::APP_DIR .  DIRECTORY_SEPARATOR . self::CONTROLLERS_DIR . DIRECTORY_SEPARATOR . mb_convert_case($pieces[0], MB_CASE_TITLE) . "Controller.php";
      // try {
      //   $Controller = new $class_name();
      // } catch (Exception $e) {
      //
      // }

			if (file_exists($file_name)) {
				require($file_name);
			} else {
				throw new Exception("Method $pieces[0] does not exists", 1);
			}

			if (method_exists($class_name, $method_name)) {
				$ReflectionMethod =  new ReflectionMethod($class_name, $method_name);
				foreach( $ReflectionMethod->getParameters() as $param) {
		      $args[] = $param->name;
		    }
			} else {
				throw new Exception("Method $method_name does not exists", 1);
			}

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

			$controller = new $class_name();
			$result = $controller->$method_name(...$params);
			echo $result;

		} catch (Exception $e) {
		  echo $e;
		}
	}
}
