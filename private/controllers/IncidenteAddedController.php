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

    if (!isset($args['nombre_objeto']))
      return false;

    if (!isset($args['cantidad_objeto']))
      return false;

    if (!isset($args['descripcion_objeto']))
      return false;

    if (empty($args['descripcion']))
      return false;

    if (!is_numeric($args['tipo_incidente']))
      return false;

    return true;
  }

  private function sendRequest($args)
  {
    $objetos = [];
    for ($i = 0; $i < count($args['nombre_objeto']); $i++)
    {
      $nombre = $args['nombre_objeto'][$i];
      $cantidad = $args['cantidad_objeto'][$i];
      $descripcion = $args['descripcion_objeto'][$i];

      if (!isset($nombre) || empty($nombre))
        break;

      if (!isset($cantidad) || !is_numeric($cantidad))
        break;

      if (!isset($descripcion))
        break;

      $objetos[] = array(
        'nombre' => $nombre,
        'cantidad' => $cantidad,
        'descripcion' => $descripcion);
    }

    return $this->getRepository()->create($this->getSession()->getUserId(), $args['descripcion'], $args['tipo_incidente'], $objetos);
  }

  protected function doShowView($args)
  {
    if ($this->sendRequest($args))
      $view = $this->getView();
  else
      $view = $this->getErrorView('No se pudo registrar el incidente, intente nuevamente');

    $view->show();
  }
}