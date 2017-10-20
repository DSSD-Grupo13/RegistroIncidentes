<?php
class PacientAddedView extends TwigView
{
  protected function getTemplateFile()
  {
    return "pacient_added.html";
  }

  public function show()
  {
    $this->render();
  }
}