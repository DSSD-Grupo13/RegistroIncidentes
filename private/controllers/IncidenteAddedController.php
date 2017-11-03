<?php
class IncidenteAddedController extends Controller
{
  private $view;
  private $repository;

  public function __construct($view, $repository)
  {
    $this->view = $view;
    $this->repository = $repository;
  }

  protected function getRepository()
  {
    return $this->repository;
  }

  protected function getView()
  {
    return $this->view;
  }

  protected function checkArgs($args)
  {
    if (!$this->getSession()->getIsLoggedIn())
      return false;

    if (!isset($args['descripcion']))
      return false;

    if (!isset($args['tipo_incidente']))
      return false;

    if (empty($args['descripcion']))
      return false;

    if (!is_numeric($args['tipo_incidente']))
      return false;

    return true;
  }

  private function canCreate($args)
  {
    return $this->getRepository()->create($this->getSession()->getUserId(), $args['descripcion'], $args['tipo_incidente']);
  }

  private function doCreate($args)
  {
    $id = $this->canCreate($args);
    return $this->getView();
  }

  protected function doShowView($args)
  {
     $this->doCreate($args)->show();
  }
}