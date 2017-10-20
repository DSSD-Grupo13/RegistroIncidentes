<?php
class PacientUpdatedView extends TwigView{
  
  protected function getTemplateFile(){
  	return "pacient_updated.html";
  }
   public function show()
  {
    $this->render();
  }

}