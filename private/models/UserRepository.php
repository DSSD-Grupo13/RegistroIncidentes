<?php
class UserRepository extends Repository
{
  private function decodeResponse($response)
  {
    return json_decode($response->getBody()->getContents());
  }

  public function getAll()
  {
    $response = $this->get('/usuarios');
    return $this->decodeResponse($response);
  }

  public function create($nombreUsuario, $mail, $contrasena, $nombre, $apellido, $dni)
  {
    $args = [
      'nombreUsuario'=> $nombreUsuario,
      'mail'=> $mail,
      'contrasena'=> $contrasena,
      'nombre'=> $nombre,
      'apellido'=> $apellido,
      'dni' => $dni
    ];

    $response = $this->post('/usuarios', $args);
    return $response->getStatusCode() == 200;
  }

  public function getUser($idUsuario)
  {
    $response = $this->get("/usuarios/$idUsuario");
    return $this->decodeResponse($response)[0];
  }

  public function containsUser($nombreUsuario, $contrasena)
  {
    return ($this->findUser($nombreUsuario, $contrasena) != null);
  }

  public function findUser($nombreUsuario, $contrasena)
  {
    $users = $this->getAll();
    foreach ($users as &$element)
    {
      if (($element->{'nombreUsuario'} == $nombreUsuario) && ($element->{'contrasena'} == $contrasena))
        return $element;
    }

    return null;
  }

  public function userNameExists($nombreUsuario)
  {
    $users = $this->getAll();
    foreach ($users as &$element)
    {
      if ($element->{'nombreUsuario'} == $nombreUsuario)
        return true;
    }

    return false;
  }
}

