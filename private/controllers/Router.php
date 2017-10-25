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
      $indexView = new IndexView;
      $loginView = new LoginView;
      $indexController = new IndexController($indexView);
      self::$router = new router($userRepository);

      self::$router->addController('index', $indexController);
      self::$router->addController('login', new LoginController($loginView));
      self::$router->addController('do-login', new DoLoginController(new $indexView, $loginView, $userRepository));
      self::$router->addController('do-logout', new DoLogoutController($indexController));

      $userListController = new UserListController(new UserListView, $userRepository);
      self::$router->addController('users_index', $userListController);
      self::$router->addController('user_new', new UserNewController(new NewUserView, $userRepository));
      self::$router->addController('user_added', new UserAddedController(new UserAddedView, $userRepository));
      self::$router->addController('user_form_update', new UserFormController(new EditUserView, $userRepository));
      self::$router->addController('user_updated', new UserUpdatedController(new UserUpdatedView, $userRepository));
      self::$router->addController('user_destroy', new UserDestroyedController(new UserDestroyedView, $userRepository));
    }

    return self::$router;
  }
}
