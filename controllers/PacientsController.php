<?php
abstract class PacientsController extends Controller
{
  private $view;

  public function __construct($view)
  {
    $this->view = $view;
  }

  protected function doShowView($args)
  {
    $this->getView()->show($args);
  }

  protected function getView()
  {
    return $this->view;
  }
}

class PacientNewController extends PacientsController
{
}

abstract class PacientsCRUDController extends PacientsController
{
  private $repository;
  private static $gender_types = array('F', 'M');

  public function __construct($view, $repository)
  {
    parent::__construct($view);
    $this->repository = $repository;
  }

  protected function getRepository()
  {
    return $this->repository;
  }

  protected function checkArgs($args)
  {
    if (!isset($args['first_name']))
      return false;

    if (!isset($args['last_name']))
      return false;

    if (!isset($args['birth_date']))
      return false;

    if (!isset($args['gender']))
      return false;

    if (!isset($args['doc_type']))
      return false;

    if (!isset($args['dni']))
      return false;

    if (!isset($args['address']))
      return false;

    if (!isset($args['phone']))
      return false;

    if (!isset($args['id_medical_insurance']))
      return false;

    if (!isset($args['has_electricity']))
      return false;

    if (!isset($args['has_pet']))
      return false;

    if (!isset($args['has_refrigerator']))
      return false;

    if (!isset($args['heating_type']))
      return false;

    if (!isset($args['home_type']))
      return false;

    if (!isset($args['water_type']))
      return false;

    if (empty($args['first_name']))
      return false;

    if (empty($args['last_name']))
      return false;

    if (empty($args['birth_date']))
      return false;

    if (empty($args['gender']))
      return false;

    if (empty($args['doc_type']))
      return false;

    if (empty($args['dni']))
      return false;

    if (empty($args['address']))
      return false;

    if (empty($args['phone']))
      return false;

    if (empty($args['id_medical_insurance']))
      return false;

    if (empty($args['has_electricity']))
      return false;

    if (empty($args['has_pet']))
      return false;

    if (empty($args['has_refrigerator']))
      return false;

    if (empty($args['heating_type']))
      return false;

    if (empty($args['home_type']))
      return false;

    if (empty($args['water_type']))
      return false;

    if (!is_numeric($args['dni']))
      return false;

    if (!in_array($args['gender'], self::$gender_types))
      return false;

    return true;
  }
}

class PacientAddedController extends PacientsCRUDController
{
  private function canCreate($args)
  {
    return $this->getRepository()->create(
      $args['first_name'],
      $args['last_name'],
      $args['birth_date'],
      $args['gender'],
      $args['doc_type'],
      $args['dni'],
      $args['address'],
      $args['phone'],
      $args['id_medical_insurance'],
      $args['has_electricity'],
      $args['has_pet'],
      $args['has_refrigerator'],
      $args['heating_type'],
      $args['home_type'],
      $args['water_type']
    );
  }

  private function doCreate($args)
  {
    if ($this->getRepository()->dniExists($args['dni']))
      return $this->getErrorView('El DNI ya existe en el sistema');

    if ($this->canCreate($args))
      return $this->getView();

    return $this->getErrorView('Ocurrió un error y no se pudo grabar el paciente, intente nuevamente');
  }

  protected function doShowView($args)
  {
    $this->doCreate($args)->show();
  }
}

class PacientUpdatedController extends PacientsCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return parent::checkArgs($args);
  }

  private function canUpdate($args)
  {
    return $this->getRepository()->update(
      $args['first_name'],
      $args['last_name'],
      $args['birth_date'],
      $args['gender'],
      $args['doc_type'],
      $args['dni'],
      $args['address'],
      $args['phone'],
      $args['id_medical_insurance'],
      $args['has_electricity'],
      $args['has_pet'],
      $args['has_refrigerator'],
      $args['heating_type'],
      $args['home_type'],
      $args['water_type'],
      $args['id']
    );
  }

  private function doUpdate($args)
  {
    $user = $this->getRepository()->getPacient($args['id']);

    if (($user->getDni() != $args['dni']) && ($this->getRepository()->dniExists($args['dni'])))
      return $this->getErrorView('El DNI ya existe en el sistema');

    if ($this->canUpdate($args))
      return $this->getView();

    return $this->getErrorView('Ocurrió un error y no se pudo actualizar el paciente, intente nuevamente');
  }

  protected function doShowView($args)
  {
    $this->doUpdate($args)->show();
  }
}

class PacientListController extends PacientsCRUDController
{
  private $appConfig;

  public function __construct($view, $repository, $appConfig)
  {
    parent::__construct($view, $repository);
    $this->appConfig= $appConfig;
  }

  protected function checkArgs($args)
  {
    return true;
  }

  protected function doShowView($args)
  {
    if (!isset($args['page']))
      $page = 1;
    else
      $page = $args['page'];

    if (!isset($args['filter']) || empty($args['filter']))
    {
      $data = $this->getRepository()->getAll($page);
      $data_count = $this->getRepository()->getPacientCount();
    }
    else
    {
      $data = $this->getRepository()->getAllByFilter($args['filter'], $page);
      $data_count = count($data);
    }

    $this->getView()->show($data, round($data_count / $this->appConfig->getPage_row_size()));
  }
}

class PacientEditController extends PacientsCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return true;
  }

  protected function doShowView($args)
  {
    $this->getView()->show($this->getRepository()->getPacient($args['id']));
  }
}

class PacientDestroyedController extends PacientsCRUDController
{
  protected function checkArgs($args)
  {
    if (!isset($args['id']))
      return false;

    if (!is_numeric($args['id']))
      return false;

    return true;
  }

  protected function doShowView($args)
  {
    if ($this->getRepository()->delete($args['id']))
      $this->getView()->show();
  }
}
