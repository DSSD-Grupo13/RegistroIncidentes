<?php
abstract class Controller
{
  private function getInvalidArgsView()
  {
    return new InvalidArgsView;
  }

  abstract protected function doShowView($args);

  protected function checkArgs($args)
  {
    return true;
  }

  protected function showInvalidArgsView()
  {
    $this->getInvalidArgsView()->show();
  }

  protected function getErrorView($errMsg)
  {
    return new ErrorMessageView($errMsg);
  }

  public function showView($args)
  {
    if ($this->checkArgs($args))
      $this->doShowView($args);
    else
      $this->showInvalidArgsView();
  }
}