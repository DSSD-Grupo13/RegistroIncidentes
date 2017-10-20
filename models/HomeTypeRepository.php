<?php
class HomeTypeRepository extends ReferenceDataRepository
{
  private $items;

  public function __construct()
  {
    $this->items = array(
      1 => new HomeType(1, 'Casa'),
      2 => new HomeType(2, 'Departamento'),
      3 => new HomeType(3, 'Hotel')
    );
  }

  public function getAll()
  {
    return $this->items;
  }

  public function getById($id)
  {
    return $this->items[$id];
  }
}