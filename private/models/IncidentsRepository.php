<?php
class IncidentsRepository extends PDORepository
{
  private $stmtCreate;

  public function __construct()
  {
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO incidente (descripcion, idTipoIncidente, idUsuario, fechaInicio, fechaFin, idEstado)
                                                                                 VALUES (?, ?, ?, NOW(), NOW(), ?) ");
  }

  public function create($idUsuario, $descripcion, $tipo_incidente)
  {
    if (!$this->stmtCreate->execute([$descripcion, $tipo_incidente, $idUsuario, '1']))
      return false;

    $qry = $this->newPreparedStmt("SELECT idincidente FROM incidente ORDER BY idincidente DESC LIMIT 1");
    $qry->execute();
    $id = $qry->fetchColumn();
    return $id;
  }

  public function getTiposIncidentes()
  {
    return $this->queryList("SELECT * FROM tipoincidente");
  }

  public function getIncidentesUsuario($idUsuario)
  {
    return $this->queryList("SELECT I.*, TI.nombre AS tipoincidente FROM incidente I INNER JOIN tipoincidente TI ON (I.idTipoIncidente = TI.idTipoIncidente)
                                           WHERE I.idUsuario = ?", [$idUsuario]);
  }
}