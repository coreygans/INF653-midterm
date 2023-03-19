<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
  header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
  header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
  exit();
}
include_once '../../config/Database.php';
include_once '../../model/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

if ($method === 'POST') {
  include_once 'post.php';
}

if ($method === 'GET') {
  include_once 'get.php';
}

if (($_SERVER['REQUEST_METHOD'] === 'PUT')) {
  include_once 'update.php';
}

if (($_SERVER['REQUEST_METHOD'] === 'DELETE')) {
  include_once 'delete.php';
}
