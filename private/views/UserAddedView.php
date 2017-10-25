<?php
class UserAddedView extends TwigView
{
  protected function getTemplateFile()
  {
    return "user_added.html";
  }

  public function show()
  {
    $this->render();
  }
}