<?php
abstract class PacientsFormView extends TwigView
{
  private $referenceDataService;

  protected function doShow($args = [])
  {
    $args['referenceData'] = $this->referenceDataService;
    $this->render($args);
  }

  public function __construct($referenceDataService)
  {
    $this->referenceDataService = $referenceDataService;
  }
}

class NewPacientView extends PacientsFormView
{
  protected function getTemplateFile()
  {
    return "pacient_form_new.html";
  }

  public function show($pacient)
  {
    $this->doShow([]);
  }
}

class EditPacientView extends PacientsFormView
{
  protected function getTemplateFile()
  {
    return "pacient_form_update.html";
  }

  public function show($pacient)
  {

    $this->doShow(array('pacient' => $pacient));
  }
}