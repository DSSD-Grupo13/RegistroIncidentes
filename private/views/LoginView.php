<?php
class LoginView extends TwigView
{
  protected function getTemplateFile()
  {
    return "login.html";
  }

  public function show($showLoginError = false)
  {
    $this->render(array('showLoginError' => $showLoginError));
  }
}
