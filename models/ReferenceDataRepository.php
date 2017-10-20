<?php
abstract class ReferenceDataRepository
{
  public abstract function getAll();
  public abstract function getById($id);
}