<?php
class AdminController extends Controller
{
  private $view;

  public function __construct($adminView)
  {
    $this->view = $adminView;
  }

  protected function doShowView($args)
  {
    $this->view->show();
  }
}

class AdminUpdateController extends Controller
{
  private $view;
  private $appConfig;

  public function __construct($adminView, $appConfig)
  {
    $this->view = $adminView;
    $this->appConfig = $appConfig;
  }

  protected function doShowView($args)
  {
    if ($this->appConfig->update($args['title'], $args['description'], $args['contact_mail'],
                                 $args['page_row_size'], ($args['avaiable'] == "Si")))
      $this->view->show();
  }

  protected function checkArgs($args)
  {
    if (!isset($args['title']))
      return false;

    if (!isset($args['description']))
      return false;

    if (!isset($args['contact_mail']))
      return false;

    if (!isset($args['page_row_size']))
      return false;

    if (!isset($args['avaiable']))
      return false;

    if (empty($args['title']))
      return false;

    if (empty($args['description']))
      return false;

    if (empty($args['contact_mail']))
      return false;

    if (!is_numeric($args['page_row_size']))
      return false;

    if (empty($args['avaiable']))
      return false;

    return true;
  }
}


