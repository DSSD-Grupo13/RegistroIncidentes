<?php
class DocumentTypeRepository extends ReferenceDataRepository
{
  private $items;

  public function __construct()
  {
    $this->items = array(
      1 => new Document(1, 'DNI'),
      2 => new Document(2, 'LC'),
      3 => new Document(3, 'Pasaporte extranjero')
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