<?php
namespace app\controllers;

use vendor\core\Controller;

/**
* Sample controller class
*/
class SampleController extends Controller
{

  public function sample()
  {
    return $this->JSON();
  }

}
