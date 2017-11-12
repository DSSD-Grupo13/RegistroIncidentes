<?php
class IncidentsRepository extends Repository
{
  public function create($idUsuario, $descripcion, $tipo_incidente, $objetos)
  {
    $args = [
      'idUsuario'=> $idUsuario,
      'descripcion'=> $descripcion,
      'idTipoIncidente'=> $tipo_incidente,
      'objetos' => $objetos
    ];

    $response = $this->post('/incidentes', $args);
    $json = json_decode($response->getBody()->getContents());
    if ($response->getStatusCode() != 200)
      return false;
    else
      return $json->{'id_incidente'};
  }

  public function getTiposIncidentes()
  {
    $response = $this->get('/tipos-incidente');
    return json_decode($response->getBody()->getContents());
  }

  public function getEstadosIncidentes()
  {
    $response = $this->get('/estados-incidente');
    return json_decode($response->getBody()->getContents());
  }

  public function getIncidentesUsuario($idUsuario)
  {
    $response = $this->get("/incidentes/$idUsuario");
    return json_decode($response->getBody()->getContents());
  }

  public function getTipoIncidente($idTipoIncidente)
  {
    $response = $this->get("/tipos-incidente/$idTipoIncidente");
    return json_decode($response->getBody()->getContents());
  }
}