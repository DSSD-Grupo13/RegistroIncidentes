<?php
class Router
{
  private static $router;
  private $controllers;
  private $userRepository;

  public function __construct($userRepository)
  {
    $this->controllers = [];
    $this->userRepository = $userRepository;
  }

  public function addController($key, $controller)
  {
    $this->controllers[$key] = $controller;
  }

  public function getController($key)
  {
    return $this->controllers[$key];
  }

  public static function getRouter()
  {
    if (!isset(self::$router)) {
      $userRepository = new UserRepository;
      $incidentsRepository = new IncidentsRepository;
      $indexView = new IndexView;
      $loginView = new LoginView;
      $indexController = new IndexController($indexView, $incidentsRepository);
      self::$router = new router($userRepository);

      self::$router->addController('index', $indexController);
      self::$router->addController('login', new LoginController($loginView));
      self::$router->addController('do-login', new DoLoginController($indexController, $loginView, $userRepository));
      self::$router->addController('do-logout', new DoLogoutController($indexController));
      self::$router->addController('sign-up', new SignUpController(new SignUpView));
      self::$router->addController('user_signed_up', new SignedUpController(new SignedUpView, $userRepository));

      self::$router->addController('incidente_new', new NewIncidenteController(new NewIncidenteView));
      self::$router->addController('incidente_added', new IncidenteAddedController($incidentsRepository));
      self::$router->addController('incidente_form_update', new UserFormController(new EditUserView, $userRepository));
      self::$router->addController('incidente_updated', new UserUpdatedController(new UserUpdatedView, $userRepository));
      self::$router->addController('incidente_destroy', new UserDestroyedController(new UserDestroyedView, $userRepository));
    }

    return self::$router;
  }
}
