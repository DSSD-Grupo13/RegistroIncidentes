<?php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Cookie\SessionCookieJar;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\RequestException;

class IncidenteAddedController extends Controller
{
  private $view;
  private $repository;

  public function __construct($view, $repository)
  {
    $this->view = $view;
    $this->repository = $repository;
  }

  protected function getRepository()
  {
    return $this->repository;
  }

  protected function getView()
  {
    return $this->view;
  }

  protected function checkArgs($args)
  {
    if (!$this->getSession()->getIsLoggedIn())
      return false;

    if (!isset($args['descripcion']))
      return false;

    if (!isset($args['tipo_incidente']))
      return false;

    if (empty($args['descripcion']))
      return false;

    if (!is_numeric($args['tipo_incidente']))
      return false;

    return true;
  }

  private function canCreate($args)
  {
    return $this->getRepository()->create($this->getSession()->getUserId(), $args['descripcion'], $args['tipo_incidente']);
  }

  private function doCreate($args)
  {
    $id = $this->canCreate($args);


    if ($id)
    {
    $cookieJar = new SessionCookieJar('MiCookie', true);
    $client = new Client([
        'base_uri' => 'http://localhost:8080/bonita/',
            'timeout'  => 1.0,
            'cookies' => $cookieJar
    ]);

    $response = $client->request('POST', 'loginservice', [
        'form_params' => [
            'username' => 'ortu.agustin',
            'password' => 'bpm',
            'redirect' => 'false'
        ]
    ]);

    $token = $cookieJar->getCookieByName('X-Bonita-API-Token');
    $_SESSION['X-Bonita-API-Token'] = $token->getValue();

    $client = new Client([
        'base_uri' => 'http://localhost:8080/bonita/',
            'timeout'  => 1.0,
            'cookies' => $cookieJar
    ]);

    $p = $client->request('POST', 'API/bpm/process/8436089247514239802/instantiation', 
            ['headers' => [
              'X-Bonita-API-Token' => $token->getValue()
              ]]);

    $body = json_decode($p->getBody());
    print_r($body);
    $caseId = $body['data']->caseId;
    print_r($caseId);

    $client = new Client([
        'base_uri' => 'http://localhost:8080/bonita/',
            'timeout'  => 1.0,
            'cookies' => $cookieJar
    ]);



    $response = $client->request('PUT', 'API/bpm/caseVariable/'.$caseId.'/idIncidente',
            ['headers' => [
              'X-Bonita-API-Token' => $token->getValue()
              ],
             'json' => [
              'type' => 'java.lang.Integer',
              'value'=> $id
              ]             
            ]);

      return $this->getView();
    }

    return $this->getErrorView('Ocurrió un error y no se pudo grabar el incidente, intente nuevamente');
  }

  protected function doShowView($args)
  {
     $this->doCreate($args)->show();
  }
}