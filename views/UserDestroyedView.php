<?php
class UserDestroyedView extends TwigView{
  
  protected function getTemplateFile(){
  	return "user_destroyed.html";
  }
   public function show()
  {
    $this->render();
  }

}