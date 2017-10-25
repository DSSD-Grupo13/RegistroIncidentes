<?php
class User
{
  private $id;
  private $username;
  private $password;
  private $email;
  private $active;
  private $updated_at;
  private $created_at;
  private $first_name;
  private $last_name;

  public function __construct($id, $username, $password, $email, $active, $updated_at, $created_at, $first_name, $last_name)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    $this->active = $active;
    $this->updated_at = $updated_at;
    $this->created_at = $created_at;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getActive()
  {
    return $this->active;
  }

  public function getUpdated_at()
  {
    return $this->updated_at;
  }

  public function getCreated_at()
  {
    return $this->created_at;
  }

  public function getFirst_name()
  {
    return $this->first_name;
  }

  public function getLast_name()
  {
    return $this->last_name;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getFull_Name()
  {
    return $this->getFirst_Name() . ',' . $this->getLast_Name();
  }
}