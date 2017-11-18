<?php
class NewIncidenteView extends TwigView
{
  protected function getTemplateFile()
  {
    return 'incidente_form_new.html';
  }

  public function show()
  {
    $this->render([
        'idUsuario' => $this->getSession()->getUserId()
    ]);
  }
}