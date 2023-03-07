<?php
$name = $_POST('name');

if(isset($name)) {
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
  
  $name = htmlspecialchars($_POST['name']);

  // Get raw posted data
  //$data = json_decode(file_get_contents("php://input"));

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