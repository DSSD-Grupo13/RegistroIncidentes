<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "./private/autoloader.php";
session_start();

if (isset($_GET['action']))
  Router::getRouter()->getController($_GET['action'])->showView($_POST);
else
  Router::getRouter()->getController('index')->showView($_POST);