<?php
class NewIncidenteController extends Controller
{
  private $view;

  public function __construct($view)
  {
      $this->view = $view;
    }

    protected function doShowView($args)
    {
      $this->view->show();
    }
}