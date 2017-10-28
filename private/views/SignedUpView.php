<?php
class SignedUpView extends TwigView
{
  protected function getTemplateFile()
  {
    return 'signed_up.html';
  }

  public function show()
  {
    $this->render();
  }
}