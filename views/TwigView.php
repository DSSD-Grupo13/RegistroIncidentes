<?php
abstract class TwigView
{
  private static $twig;
  private static $appConfig;

  private static function getTwig()
  {
    if (!isset(self::$twig)) {
      Twig_Autoloader::register();
      $loader = new Twig_Loader_Filesystem('./templates');
      self::$twig = new Twig_Environment($loader);
    }
    return self::$twig;
  }

  private static function getAppConfig()
  {
    return self::$appConfig;
  }

  private function getSession()
  {
    return new Session();
  }

  protected abstract function getTemplateFile();

  protected function render($args = [])
  {
    $args['config'] = self::getAppConfig();
    $args['session'] = $this->getSession();
    echo self::getTwig()->render($this->getTemplateFile(), $args);
  }

  public static function setAppConfig($appConfig)
  {
    self::$appConfig = $appConfig;
  }
}
