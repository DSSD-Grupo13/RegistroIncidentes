<?php
abstract class Repository
{
  protected $api_client;

  public function __construct()
  {
    $this->api_client = new \APIClient;
  }

  public function get($endpoint)
  {
    return $this->api_client->get($endpoint);
  }

  public function post($endpoint, $args)
  {
    return $this->api_client->post($endpoint, $args);
  }
}