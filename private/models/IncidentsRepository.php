<?php
class IncidentsRepository extends Repository
{
  public function create($idUsuario, $descripcion, $tipo_incidente)
  {
    $args = [
      'idUsuario'=> $idUsuario,
      'descripcion'=> $descripcion,
      'idTipoIncidente'=> $tipo_incidente
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

  public function getIncidentesUsuario($idUsuario)
  {
    $response = $this->get("/incidentes/$idUsuario");
    return json_decode($response->getBody()->getContents());
  }
}