<?php
class NewIncidenteView extends TwigView
{
  private $repository;

public function __construct($repository)
{
  $this->repository = $repository;
}

  protected function getTemplateFile()
  {
    return 'incidente_form_new.html';
  }

  private function getRepository()
  {
    return $this->repository;
  }

  public function show()
  {
    $this->render(array(
      'idUsuario' => $this->getSession()->getUserId(),
      'tipos_incidentes' => $this->getRepository()->getTiposIncidentes()));
  }
}