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
    
  }

  // public function setAccessControlOrigin()
  // {
  //   $this->headers[] = "Access-Control-Allow-Origin: *";
  // }
  //
  // public function setAccessControlMethods()
  // {
  //   $this->headers[] = "Access-Control-Allow-Methods: *";
  // }

  public function setHeaders(fSettings $as)
  {
    $headers = $as->getAccessControlHeaders();
  }

  public function sendHeaders()
  {
    foreach ($this->headers as $header) {
      header($header);
    }
  }
}
