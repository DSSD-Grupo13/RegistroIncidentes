<?php
class UserUpdatedView extends TwigView
{
  protected function getTemplateFile()
  {
    return "user_updated.html";
  }

  public function show()
  {
    $this->render();
  }
}