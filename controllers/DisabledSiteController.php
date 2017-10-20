<?php
class DisabledSiteController extends Controller
{
  private $view;

  public function __construct()
  {
    $this->view = new DisabledSiteView;
  }

  protected function doShowView($args)
  {
    $this->view->show($args);
  }
}