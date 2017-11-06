<?php
class IndexView extends TwigView
{
  protected function getTemplateFile()
  {
    if ($this->getSession()->getIsLoggedIn())
      return "index.html";
    else
      return "empty_index.html";
  }

  public function show($incidents, $incidentTypes, $incidentStates)
  {
    $this->render([
        'incidents' => $incidents,
        'incidentTypes' =>$incidentTypes,
        'incidentStates' => $incidentStates
      ]
    );
  }
}
