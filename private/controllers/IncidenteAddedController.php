<?php
class IncidenteAddedController extends Controller
{
  private $repository;
  private $response;

  public function __construct($repository)
  {
    $this->repository = $repository;
  }

  protected function getRepository()
  {
    return $this->repository;
  }

  protected function getView($message)
  {
    return (new IncidenteAddedView($message));
  }

  protected function checkArgs($args)
  {
    if (!$this->getSession()->getIsLoggedIn())
      return false;

    if (!isset($args['descripcion']))
      return false;

    if (!isset($args['nombre_objeto']))
      return false;

    if (!isset($args['cantidad_objeto']))
      return false;

    if (!isset($args['descripcion_objeto']))
      return false;

    if (empty($args['descripcion']))
      return false;

    return true;
  }

  private function sendRequest($args)
  {
    unset($this->response);
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

    $this->response = $this->getRepository()->create($this->getSession()->getUserId(), $args['descripcion'], $objetos);
    return (($this->response) != false);
  }

  protected function doShowView($args)
  {
    if ($this->sendRequest($args))
      $view = $this->getView($this->response->{'message'});
    else
      $view = $this->getErrorView('No se pudo registrar el incidente, intente nuevamente');

    $view->show();
  }
}