<?php
namespace vendor\core;

/**
 *
 */
class fSettings
{
  protected $dbConnection;
  protected $accessControl;

  function __construct(array $settings)
  {
    if (isset($settings['dbConnection'])) {
      $this->dbConnection = $settings['dbConnection'];
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
