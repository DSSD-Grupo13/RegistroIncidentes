<?php
class WaterTypeRepository extends ReferenceDataRepository
{
  private $items;

  public function __construct()
  {
    $this->items = array(
      1 => new WaterType(1, 'Corriente'),
      2 => new WaterType(2, 'Pozo'),
      3 => new WaterType(3, 'No posee')
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