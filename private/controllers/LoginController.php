<?php
class LoginController extends Controller
{
  private $view;

  public function __construct($loginView)
  {
    $this->view = $loginView;
  }

  protected function doShowView($args)
  {
    $this->view->show();
  }
}

class DoLoginController extends Controller
{
  private $indexController;
  private $loginView;
  private $userRepository;

  public function __construct($indexController, $loginView, $userRepository)
  {
    $this->indexController = $indexController;
    $this->loginView = $loginView;
    $this->userRepository = $userRepository;
  }

  protected function showInvalidArgsView()
  {
    $this->loginView->show(true);
  }

  protected function checkArgs($args)
  {
    if (!isset($args['username']))
      return false;

    if (!isset($args['password']))
      return false;

    return true;
  }

  protected function doShowView($args)
  {
    if ($this->userRepository->containsUser($args['username'], $args['password']))
    {
      $user = $this->userRepository->findUser($args['username'], $args['password']);
      $_SESSION['userId'] = $user->{'id'};
      $_SESSION['userName'] = $user->{'apellido'} . ' ' . $user->{'nombre'};
      $this->indexController->showView([]);
    }
    else
      $this->showInvalidArgsView();
  }
}

class DoLogoutController extends Controller
{
  private $indexController;

  public function __construct($indexController)
  {
    $this->indexController = $indexController;
  }

  protected function doShowView($args)
  {
    session_unset();
    session_destroy();
    $this->indexController->showView($args);
  }
}
