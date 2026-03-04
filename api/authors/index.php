<?php
header('Access-Control-Allow-Origin: *');

  header('Content-Type: application/json');

  $method = $_SERVER['REQUEST_METHOD'];



  if ($method === 'OPTIONS') {

    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');

    exit();

  }
  require_once '../../config/Database.php';

  $database = new Database();
  $db = $database->connect();

  