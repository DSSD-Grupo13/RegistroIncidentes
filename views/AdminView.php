<?php
class AdminView extends TwigView
{
  protected function getTemplateFile()
  {
    return "administracion.html";
  }

  public function show()
  {
    $this->render();
  }
}
