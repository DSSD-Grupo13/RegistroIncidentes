<?php
abstract class UsersController extends Controller
{
  private $view;

  public function __construct($view)
  {
    $this->view = $view;
  }

  protected function doShowView($args)
  {
    $this->getView()->show($args);
  }

  protected function getView()
  {
    return $this->view;
  }
}

class UserNewController extends UsersController
{
}

abstract class UsersCRUDController extends UsersController
{
  private $repository;

  public function __construct($view, $repository)
  {
    parent::__construct($view);
    $this->repository = $repository;
  }

  protected function getRepository()
  {
    return $this->repository;
  }

  protected function checkArgs($args)
  {
    if (!isset($args['email']))
      return false;

    if (!isset($args['password']))
      return false;

    if (!isset($args['first_name']))
      return false;

    if (!isset($args['last_name']))
      return false;

    if (empty($args['email']))
      return false;

    if (empty($args['password']))
      return false;

    if (empty($args['first_name']))
      return false;

    if (empty($args['last_name']))
      return false;

    return true;
  }
}

class UserAddedController extends UsersCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['username']))
      return false;

    if (empty($args['username']))
      return false;

    return parent::checkArgs($args);
  }

  private function canCreate($args)
  {
    return $this->getRepository()->create($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name']);
  }

  private function doCreate($args)
  {
    if ($this->getRepository()->userNameExists($args['username']))
      return $this->getErrorView('El nombre de usuario ya existe');

    if ($this->canCreate($args))
      return $this->getView();

    return $this->getErrorView('Ocurrió un error y no se pudo grabar el usuario, intente nuevamente');
  }

  protected function doShowView($args)
  {
    $this->doCreate($args)->show();
  }
}

class UserUpdatedController extends UsersCRUDController
{
  private function canUpdate($args)
  {
    return $this->getRepository()->update($args['email'], $args['password'], $args['first_name'], $args['last_name'], $args['id']);
  }

  private function doUpdate($args)
  {
    if ($this->canUpdate($args))
      return $this->getView();

    return $this->getErrorView('Ocurrió un error y no se pudo actualizar el usuario, intente nuevamente');
  }

  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return parent::checkArgs($args);
  }

  protected function doShowView($args)
  {
    $this->doUpdate($args)->show();
  }
}

class UserFormController extends UsersCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return true;
  }

  protected function doShowView($args)
  {
    $this->getView()->show($this->getRepository()->getUser($args['id']));
  }
}

class UserListController extends UsersCRUDController
{
  private $appConfig;

  public function __construct($view, $repository, $appConfig)
  {
    parent::__construct($view, $repository);
    $this->appConfig = $appConfig;
  }

  protected function checkArgs($args)
  {
    return true;
  }

  protected function doShowView($args)
  {
    if (!isset($args['page']))
      $page = 1;
    else
      $page = $args['page'];

    if (!isset($args['users_state']))
      $users_state = true;
    else
      $users_state =  $args['users_state'] == "Activos";

    if (!isset($args['filter']) || empty($args['filter']))
      {
      $data = $this->getRepository()->getAll($page, $users_state);
      $data_count = $this->getRepository()->getUserCount();
    }
    else
      {
      $data = $this->getRepository()->getAllByFilter($args['filter'], $page, $users_state);
      $data_count = count($data);
    }

    $this->getView()->show($data, round($data_count / $this->appConfig->getPage_row_size()));
  }
}

class UserToggleStatusController extends Controller
{
  private $userListController;
  private $repository;

  public function __construct($userListController, $repository)
  {
    $this->repository = $repository;
    $this->userListController = $userListController;
  }

  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return true;
  }

  protected function doShowView($args)
  {
    $this->repository->toggleActive($args['id']);
    $this->userListController->showView([]);
  }
}

class UserDestroyedController extends UsersCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return true;
  }

  protected function doShowView($args)
  {
    if ($this->getRepository()->delete($args['id']))
      $this->getView()->show();
  }
}
