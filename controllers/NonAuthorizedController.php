<?php
class NonAuthorizedController extends Controller
{
  private $view;

  public function __construct()
  {
    $this->view = new NonAuthorizedView;
  }

  protected function doShowView($args)
  {
    $this->view->show();
  }
}