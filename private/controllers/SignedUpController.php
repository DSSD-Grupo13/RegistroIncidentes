<?php
class SignedUpController extends Controller
{
  private $view;
  private $userRepository;

  public function __construct($view, $userRepository)
  {
    $this->view = $view;
    $this->userRepository = $userRepository;
  }

  private function getView()
  {
    return $this->view;
  }

  private function getRepository()
  {
    return $this->userRepository;
  }

  private function canCreate($args)
  {
    return $this->getRepository()->create($args['username'], $args['email'], $args['password'], $args['first_name'], $args['last_name'], $args['dni']);
  }

  private function doCreate($args)
  {
    if ($this->getRepository()->userNameExists($args['username']))
      return $this->getErrorView('El nombre de usuario ya existe');

    if ($this->canCreate($args))
      return $this->getView();

    return $this->getErrorView('Ocurrió un error y no se pudo grabar el usuario, intente nuevamente');
  }

  protected function checkArgs($args)
  {
    if (!isset($args['username']))
      return false;

    if (!isset($args['email']))
      return false;

    if (!isset($args['password']))
      return false;

    if (!isset($args['first_name']))
      return false;

    if (!isset($args['last_name']))
      return false;

    if (!isset($args['dni']))
      return false;

    if (empty($args['email']))
      return false;

    if (empty($args['password']))
      return false;

    if (empty($args['first_name']))
      return false;

    if (empty($args['last_name']))
      return false;

    if (empty($args['username']))
      return false;

    if (empty($args['dni']))
      return false;

    return true;
  }

  protected function doShowView($args)
  {
    $this->doCreate($args)->show();
  }
}