<?php
namespace vendor\core;

/**
 *
 */
class Headers
{

  private $headers = [];

  function __construct(Settings $settings)
  {
    $this->headers = $settings->getAccessControlHeaders();
  }

  public function setHeaders(Settings $as)
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
