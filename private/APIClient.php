<?php
use GuzzleHttp\Exception\RequestException;

class BadRequestException extends Exception
{
  public function __construct($json_error_response)
  {
    parent::__construct($json_error_response->{'description'}, $json_error_response->{'error_code'});
  }
}

class APIClient {
  public static $API_BASE_URI = 'http://api-incidentes.com/';
  private $client;

  public function __construct($api_base_uri = '')
  {
    if (empty($api_base_uri))
      $api_base_uri = self::$API_BASE_URI;

    $this->client = new \GuzzleHttp\Client(['base_uri' => $api_base_uri]);
  }

  public function get($endpoint)
  {
    return $this->executeRequest('GET', $endpoint);
  }

  public function post($endpoint, $args)
  {
    return $this->executeRequest('POST', $endpoint, $args);
  }

  private function executeRequest($method, $endpoint, $args = NULL)
  {
    try
    {
      $response = $this->client->request($method, $endpoint, ['form_params' => $args]);
      if ($response->getStatusCode() == 400)
        throw new \BadRequestException( \json_decode($response->getBody()->getContents()));

      return $response;
    }
    catch (RequestException $e)
    {
      if ($e->hasResponse())
        return ($e->getResponse());
    }
  }
}
