<?php
class Session
{
  public function getIsLoggedIn()
  {
    return isset($_SESSION['userId']);
  }

  public function getUserId()
  {
    if ($this->getIsLoggedIn())
      return $_SESSION['userId'];
    else
      return -1;
  }
}