<?php
class SignUpView extends TwigView
{
  protected function getTemplateFile()
  {
    return 'sign_up.html';
  }

  public function show()
  {
    $this->render();
  }
}