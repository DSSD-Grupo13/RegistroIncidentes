<?php
class InvalidArgsView extends TwigView
{
  protected function getTemplateFile()
  {
    return "invalid_args.html";
  }

  public function show()
  {
    $this->render();
  }
}