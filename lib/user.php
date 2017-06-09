<?php
namespace authentication;

include 'model.php';

use general\Model;

/**
* User model class
*/
class User extends Model
{
  
  public $id;
  public $login;
  public $password;
  public $firstName;
  public $lastName;
  public $registrationDate;

  function __construct() {
    $this->id = uniqid("", true); 
    $this->registrationDate = date('Y-m-d H:i:s', strtotime('today'));
  }
  
}