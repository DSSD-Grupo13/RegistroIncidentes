<?php
class User
{
  private $id;
  private $nombreUsuario;
  private $contrasena;
  private $email;
  private $dni;
  private $nombre;
  private $apellido;

  public function __construct($id, $nombreUsuario, $contrasena, $email, $dni, $nombre, $apellido)
  {
    $this->id = $id;
    $this->nombreUsuario = $nombreUsuario;
    $this->contrasena = $contrasena;
    $this->email = $email;
    $this->dni = $dni;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getNombreUsuario()
  {
    return $this->nombreUsuario;
  }

  public function getContrasena()
  {
    return $this->contrasena;
  }

  public function getDni()
  {
    return $this->dni;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function getApellido()
  {
    return $this->apellido;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getFull_Name()
  {
    return $this->getNombre() . ',' . $this->getApellido();
  }
}