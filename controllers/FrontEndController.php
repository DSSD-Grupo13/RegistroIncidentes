<?php
class FrontEndController
{
  private $controllers;
  private $appConfig;
  private $disabledSiteController;
  private $nonAuthorizedController;
  private $userRepository;
  private static $admin_actions = array('admin', 'admin_updated');

  private function getUserSession()
  {
    return new UserSession($this->userRepository);
  }

  public function __construct($appConfig, $userRepository)
  {
    $this->disabledSiteController = new DisabledSiteController;
    $this->nonAuthorizedController = new NonAuthorizedController;
    $this->appConfig = $appConfig;
    $this->controllers = [];
    $this->userRepository = $userRepository;
  }

  public function addController($key, $controller)
  {
    $this->controllers[$key] = $controller;
  }

  public function getController($key)
  {
    if (!$this->appConfig->getIsSiteEnabled())
    {
      if (($this->getUserSession()->hasRole('ADMINISTRADOR')) && (in_array($key, self::$admin_actions)))
        return $this->controllers[$key];
      else
        return $this->disabledSiteController;
    }

    if (!$this->getUserSession()->hasPermission($key))
      return $this->nonAuthorizedController;

    return $this->controllers[$key];
  }
}
