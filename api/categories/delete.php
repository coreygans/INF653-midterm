<?php

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);

$id = $data['id'];


if(empty($id)) {
  //I don't think we need this error message (confirming in Discord)
  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
}

elseif(!empty($id)) {
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
   

  $category->id = $id;

    // Create category
  $category->delete();
 
}

else{
echo json_encode(
    array('message' => 'Missing Required Parameters')
  );

}