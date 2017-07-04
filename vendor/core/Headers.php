<?php
namespace vendor\core;

/**
 *
 */
class Headers
{
  private $headers = [];

  function __construct()
  {
    # code...
  }

  public function setAccessControlOrigin()
  {
    $this->headers[] = "Access-Control-Allow-Origin: *";
  }

  public function setAccessControlMethods()
  {
    $this->headers[] = "Access-Control-Allow-Methods: *";
  }

  public function setHeaders(fSettings $settings)
  {
    // $headers = $settings->getAccessControlHeaders();
  }

  public function sendHeaders()
  {
    foreach ($headers as $header) {
      header($header);
    }
  }
}
