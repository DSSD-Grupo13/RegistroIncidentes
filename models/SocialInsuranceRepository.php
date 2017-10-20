<?php
class SocialInsuranceRepository extends ReferenceDataRepository
{
  private $items;

  public function __construct()
  {
    $this->items = array(
      1 => new SocialInsurance(1, 'IOMA'),
      2 => new SocialInsurance(2, 'OSECAC'),
      3 => new SocialInsurance(3, 'OSDE'),
      4 => new SocialInsurance(4, 'Medicus'),
      5 => new SocialInsurance(5, 'No posee')
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