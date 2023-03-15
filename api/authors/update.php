<?php

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);

$id = null;
$name = null;

$id = $data['id'];
$name = $data['author'];


if(empty($name) || empty($id) || !is_int($id)) {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
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
   

  $author->name = $name;  
  $author->id = $id;

    // Create author
  $author->update();
 
}

else{
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
  
echo json_encode(
    array('message' => 'Missing Required Parameters')
  );

}