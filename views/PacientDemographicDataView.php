<?php
class PacientDemographicDataView extends TwigView
{
  private $referenceDataService;

  public function __construct($referenceDataService)
  {
    $this->referenceDataService = $referenceDataService;
  }

  protected function getTemplateFile()
  {
    return "pacient_demographic_data.html";
  }

  public function show($pacient)
  {
    $this->render(array(
      'pacient' => $pacient,
      'referenceData' => $this->referenceDataService
    ));
  }
}