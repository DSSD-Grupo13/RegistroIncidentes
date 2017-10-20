<?php
class DisabledSiteView extends TwigView
{
  protected function getTemplateFile()
  {
    return "disabled_site.html";
  }

  public function show()
  {
    $this->render();
  }
}
