<?php
class HeatingTypeRepository extends ReferenceDataRepository
{
  private $items;

  public function __construct()
  {
    $this->items = array(
      1 => new HeatingType(1, 'Estufa'),
      2 => new HeatingType(2, 'Aire Acondicionado'),
      3 => new HeatingType(3, 'No posee')
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