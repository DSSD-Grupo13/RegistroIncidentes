<?php
class NonAuthorizedView extends TwigView
{
  protected function getTemplateFile()
  {
    return "non_authorized.html";
  }

  public function show()
  {
    $this->render();
  }
}