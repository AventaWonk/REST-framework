<?php
namespace app\controllers;

use vendor\core\Controller;
use app\models\Sample;

/**
* Sample controller class
*/
class SampleController extends Controller
{

  public function add($text = 'test')
  {
    $sample = new Sample();
    $sample->text = $text;
		Sample::add($sample);

    return $this->JSON();
  }

  public function get()
  {
    $samples = Sample::findAll();

    return $this->JSON($samples);
  }

  public function update($id, $text)
  {
    $samples = Sample::findById($id);
    $samples->text = $text;
    $samles->save();
    
    return $this->JSON();
  }

  public function delete($id)
  {
    $samples = Sample::findById($id);
    $sample->delete();

    return $this->JSON();
  }

}
