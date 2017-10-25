<?php
abstract class TwigView
{
  private static $twig;

  private static function getTwig()
  {
    if (!isset(self::$twig)) {
      Twig_Autoloader::register();
      $loader = new Twig_Loader_Filesystem('./private/templates');
      self::$twig = new Twig_Environment($loader);
    }
    return self::$twig;
  }

  protected function getSession()
  {
    return new Session();
  }

  protected abstract function getTemplateFile();

  protected function render($args = [])
  {
    $args['session'] = $this->getSession();
    echo self::getTwig()->render($this->getTemplateFile(), $args);
  }
}
