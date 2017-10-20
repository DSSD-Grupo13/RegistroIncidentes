<?php
class UserSession
{
  private static $allowed_for_all = array('index', 'login', 'do-login', 'do-logout');
  private $userRepository;

  public function __construct($userRepository)
  {
    $this->userRepository = $userRepository;
  }

  private function getSession()
  {
    return new Session();
  }

  private function getUserId()
  {
    return $this->getSession()->getUserId();
  }

  public function hasPermission($action)
  {
    if (in_array($action, self::$allowed_for_all))
      return true;

    if (!$this->getSession()->getIsLoggedIn())
      return false;

    return $this->userRepository->hasPermission($this->getUserId(), $action);
  }

  public function hasRole($roleName)
  {
    return $this->userRepository->hasRole($this->getUserId(), $roleName);
  }
}