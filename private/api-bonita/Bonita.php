<?php
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class Bonita
{
  private $username;
  private $password;

  public function __construct($username, $password)
  {
    Middleware::cookies();
    $this->username = $username;
    $this->password = $password;
  }

  public function setearVariable($idCaso, $nombreVariable, $tipoVariable, $valorVariable)
  {
    $token = $this->login();
    try {
      $response = $this->createClient()->request(
        'PUT',
        "API/bpm/caseVariable/$idCaso/nombreVariable",
        [
          'headers' => [
            'X-Bonita-API-Token' => $token->getValue()
          ],
          'json' => [
            'type' => $tipoVariable,
            'value' => $valorVariable
          ]
        ]
      );

      $body = $response->getBody();
      return json_decode($body);
    }
    finally {
      $this->logout();
    }
  }

  public function instanciarProceso($idProceso)
  {
  $token = $this->login();
    try {
      $response = $this->createClient()->request(
        'POST',
        "API/bpm/process/$idProceso/instantiation",
        [
          'headers' => [
            'X-Bonita-API-Token' => $token->getValue()
          ]
        ]
      );

      $body = $response->getBody();
      return json_decode($body)->{'caseId'};
    }
    finally {
      $this->logout();
    }
  }

  public function obtenerIdProceso()
  {
    $token = $this->login();
    try {
      $response = $this->createClient()->request(
        'GET',
        "API/bpm/process/?p=0&c=1000",
        [
          'headers' => [
            'X-Bonita-API-Token' => $token->getValue()
          ]
        ]
      );

      $body = $response->getBody();
      $procesos = json_decode($body);
      return $procesos[0]->{'id'};
    }
    finally {
      $this->logout();
    }
  }

  private function login()
  {
    $client = $this->createClient();

    $response = $client->request('POST', 'loginservice', [
      'form_params' => [
        'username' => $this->username,
        'password' => $this->password,
        'redirect' => 'false'
      ]
    ]);

    $cookies = $client->getConfig('cookies') ;
    return $cookies->getCookieByName('X-Bonita-API-Token');
  }

  private function logout()
  {
    return $this->createClient()->request('GET', 'logoutservice', [
      'form_params' => [
        'redirect' => 'false'
      ]
    ]);
  }

  private function createClient()
  {
    return new Client([
      'base_uri' => 'http://localhost:8080/bonita/',
      'cookies' => new GuzzleHttp\Cookie\SessionCookieJar('cookies-bonita', true)
    ]);
  }
}