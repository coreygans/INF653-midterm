<?php

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);

 $name = htmlspecialchars($data['name']);


if(isset($name)) {
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
   

  $category->name = $name;  

    // Create category
  $category->create();
 
}

elseif($name = null) {
  //I don't think we need this error message (confirming in Discord)
  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
}