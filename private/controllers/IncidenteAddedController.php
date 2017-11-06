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

  private function sendRequest($args)
  {
    return $this->getRepository()->create($this->getSession()->getUserId(), $args['descripcion'], $args['tipo_incidente']);
  }

  protected function doShowView($args)
  {
    if ($this->sendRequest($args))
    return $this->getView();
  else
    return $this->getErrorView('No se pudo registrar el incidente, intente nuevamente');
  }
}