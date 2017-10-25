<?php
class IndexView extends TwigView
{
  protected function getTemplateFile()
  {
    return "index.html";
  }

  public function show()
  {
    $this->render();
  }
}
