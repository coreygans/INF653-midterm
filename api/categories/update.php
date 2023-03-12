<?php

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);

$id = $data['id'];
$name = $data['name'];


if(empty($name) & empty($id)) {
  //I don't think we need this error message (confirming in Discord)
  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
}

elseif(!empty($name) & !empty($id)) {
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
   

  $category->name = $name;  
  $category->id = $id;

    // Create category
  $category->update();
 
}

else{
echo json_encode(
    array('message' => 'Missing Required Parameters')
  );

}