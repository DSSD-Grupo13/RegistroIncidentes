<?php
class EditUserView extends TwigView
{
  protected function getTemplateFile()
  {
    return "user_form_update.html";
  }

  public function show($user)
  {
    $this->render(array(
      'user' => $user,
      'username_disabled' => true
    ));
  }
}

class NewUserView extends TwigView
{
  protected function getTemplateFile()
  {
    return "user_form_new.html";
  }

  public function show()
  {
    $this->render(array(
      'username_disabled' => false
    ));
  }
}