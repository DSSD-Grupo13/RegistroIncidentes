<?php
class IncidenteAddedView extends TwigView
{
  protected function getTemplateFile()
  {
    return 'incidente_added.html';
  }

  public function show()
  {
    $this->render();
  }
}