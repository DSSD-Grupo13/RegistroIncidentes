<?php
class IncidenteAddedView extends TwigView
{
  private $message;

  public function __construct($message)
  {
    $this->message = $message;
  }

  public function show()
  {
    $this->render(['msg' => $this->message]);
  }

  protected function getTemplateFile()
  {
    return 'incidente_added.html';
  }
}