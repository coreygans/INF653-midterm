<?php

  include_once '../../config/Database.php';
  include_once '../../model/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

$method = $_SERVER['REQUEST_METHOD'];

if($method === 'POST') {
  include_once 'post.php';
}


if($method === 'GET') {
  include_once 'get.php';
}




if ($method === 'OPTIONS') {
  header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
  header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
  exit();
}


if(($_SERVER['REQUEST_METHOD'] === 'PUT') & ($id != null) ) {
  // Need to handle the error message in the Model as I can check the row count there
  
 }


if(($_SERVER['REQUEST_METHOD'] === 'DELETE') & ($id != null) ) {
 // Need to handle the error message in the Model as I can check the row count there
 
}
