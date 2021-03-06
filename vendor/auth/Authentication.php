<?php
namespace vendor\authentication;

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

  public function addUser(User $user)
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

  public function deleteUser(User $user)
  {
    User::delete($user->id);
  }

  public function login(User $user)
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
