<?php
class UserRepository extends PDORepository
{
  private $stmtDelete;
  private $stmtCreate;
  private $stmtUpdate;

  private function queryToUserArray($query)
  {
    $answer = [];
    foreach ($query as &$element) {
      $answer[] = new User(
        $element['idUsuario'],
        $element['nombreUsuario'],
        $element['contrasena'],
        $element['mail'],
        $element['dni'],
        $element['nombre'],
        $element['apellido']
      );
    }
    return $answer;
  }

  public function __construct()
  {
    $this->stmtDelete = $this->newPreparedStmt("DELETE FROM usuario WHERE idUsuario = ?");
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO usuario (nombreUsuario, mail, contrasena, nombre, apellido,
                                                dni)  VALUES (?, ?, ?, ?, ?, ?)");
    $this->stmtUpdate = $this->newPreparedStmt("UPDATE usuario SET mail = ?, contrasena = ?, nombre = ?, apellido = ?
                                                WHERE idUsuario = ?");
  }

  public function getAll()
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM usuario"));
  }

  public function delete($idUsuario)
  {
    return $this->stmtDelete->execute([$idUsuario]);
  }

  public function create($nombreUsuario, $mail, $contrasena, $nombre, $apellido, $dni)
  {
    return $this->stmtCreate->execute([$nombreUsuario, $mail, $contrasena, $nombre, $apellido, $dni]);
  }

  public function update($mail, $contrasena, $nombre, $apellido, $idUsuario)
  {
    return $this->stmtUpdate->execute([$mail, $contrasena, $nombre, $apellido, $idUsuario]);
  }

  public function getUser($idUsuario)
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM usuario where idUsuario = ?", [$idUsuario]))[0];
  }

  private function queryUser($nombreUsuario, $contrasena)
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM usuario where nombreUsuario = ? AND contrasena = ?", [$nombreUsuario, $contrasena]));
  }

  public function containsUser($nombreUsuario, $contrasena)
  {
    return count($this->queryUser($nombreUsuario, $contrasena)) > 0;
  }

  public function findUser($nombreUsuario, $contrasena)
  {
    return $this->queryUser($nombreUsuario, $contrasena)[0];
  }

  public function userNameExists($nombreUsuario)
  {
    return count($this->queryList("SELECT * FROM usuario where nombreUsuario = ?", [$nombreUsuario]));
  }
}

