<?php
class PacientListView extends TwigView
{
  private $referenceDataService;

  public function __construct($referenceDataService)
  {
    $this->referenceDataService = $referenceDataService;
  }

  protected function getTemplateFile()
  {
    return "pacients_index.html";
  }

  public function show($pacients, $pageCount)
  {
    $this->render(array('pacients' => $pacients,
                        'pageCount' => $pageCount,
                        'referenceData' => $this->referenceDataService));
  }
}
