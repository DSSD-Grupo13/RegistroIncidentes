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
                                                dni, localidad)  VALUES (?, ?, ?, ?, ?, ?, ?)");
    $this->stmtUpdate = $this->newPreparedStmt("UPDATE usuario SET mail = ?, contrasena = ?, nombre = ?, apellido = ?
                                                WHERE idUsuario = ?");
  }

  public function getAll()
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM usuario"));
  }

  public function delete($useridUsuario)
  {
    return $this->stmtDelete->execute([$useridUsuario]);
  }

  public function create($nombreUsuario, $mail, $contrasena, $nombre, $apellido)
  {
    return $this->stmtCreate->execute([$nombreUsuario, $mail, $contrasena, $nombre, $apellido]);
  }

  public function update($mail, $contrasena, $nombre, $apellido, $useridUsuario)
  {
    return $this->stmtUpdate->execute([$mail, $contrasena, $nombre, $apellido, $useridUsuario]);
  }

  public function getUser($useridUsuario)
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM usuario where idUsuario = ?", [$useridUsuario]))[0];
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

  public function nombreUsuarioExists($nombreUsuario)
  {
    return count($this->queryList("SELECT * FROM usuario where nombreUsuario = ?", [$nombreUsuario]));
  }
}

