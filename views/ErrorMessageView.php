<?php
class ErrorMessageView extends TwigView
{
  private $error_message;

  public function __construct($error_message)
  {
    $this->error_message = $error_message;
  }

  protected function getTemplateFile()
  {
    return 'generic_error_view.html';
  }

  public function show()
  {
    $this->render(array('error_message' => $this->error_message));
  }
}