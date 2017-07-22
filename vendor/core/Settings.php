<?php
namespace vendor\core;

/**
 *
 */
class Settings
{
  protected static $dbConnection;
  protected $accessControl;

  function __construct(array $settings)
  {
    if (isset($settings['db'])) {
      self::$dbConnection = $settings['db'];
    }

    if (isset($settings['access-control'])) {
      $this->accessControl = $settings['access-control'];
    }
  }

  /**
   * @return array
   */
  public function getAccessControlHeaders()
  {
    $headers = [];

    switch ($this->accessControl['origin']) {
      case 'ALL':
        $headers[] = 'Access-Control-Allow-Origin: *';
        break;

      case 'SELF':
        $headers[] = 'Access-Control-Allow-Origin: /';
        break;

      default:
        $headers[] = 'Access-Control-Allow-Origin: /';
        break;
    }

    return $headers;
  }

  /**
   * @static
   * @return mixed
   */
  public static function getDbConnectionString()
  {
    $host = self::$dbConnection['host'];
    $name = self::$dbConnection['name'];
    $charset = self::$dbConnection['charset'];

    return [
      "mysql:host=$host;dbname=$name;charset=$charset",
      self::$dbConnection['user'],
      self::$dbConnection['password'],
    ];
  }

  /**
   * @return mixed
   */
  public function getDbConnection()
  {
    return $this->dbConnection;
  }

  /**
   * @param mixed $dbConnection
   */
  public function setDbConnection($dbConnection)
  {
    $this->dbConnection = $dbConnection;
  }

  /**
   * @return mixed
   */
  public function getAccessControl()
  {
    return $this->accessControl;
  }

  /**
   * @param mixed $accessControl
   */
  public function setAccessControl($accessControl)
  {
    $this->accessControl = $accessControl;
  }







}
