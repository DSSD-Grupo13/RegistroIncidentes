<?php
class PacientDestroyedView extends TwigView{
  
  protected function getTemplateFile(){
  	return "pacient_destroyed.html";
  }
   public function show()
  {
    $this->render();
  }

}