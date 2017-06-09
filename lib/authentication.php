<?php
namespace authentication;

include 'user.php';

/**
* Authentication class
*/
class Authentication
{
  private static $currentUser;

  function __construct()
  {
    self::$currentUser = false;
  }

  public function addUser($user)
  {
    $findingUser = new User();
    $findingUser->registrationDate = null;
    $findingUser->login = $user->login;

    if (User::find($findingUser)) {
      return false;
    }
    $user->password = sha1($user->password);
    User::add($user);
  }

  public function deleteUser($user)
  {
    User::delete($user->id);
  }

  public function login($user)
  {
    $foundUser = User::find($user);
    if ($foundUser) {
      self::$currentUser = $foundUser;
      return true;
    } 
    return false;
  }

  public function logout()
  {
    self::$currentUser = false;
  }

  public function getUser()
  {
    return self::$currentUser;
  }

}