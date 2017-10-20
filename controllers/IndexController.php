<?php
class IndexController extends Controller
{
  private $view;

  public function __construct($indexView) {
    $this->view = $indexView;
  }

  protected function doShowView($args)
  {
    $this->view->show();
  }
}
