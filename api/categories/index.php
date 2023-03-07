<?php
// Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

$id = htmlspecialchars($_GET['id']);


if(($_SERVER['REQUEST_METHOD'] === 'GET') & (empty($id))){ 
  // Category read query
  $result = $category->read();

    // Cat array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $cat_item = array(
        'id' => $id,
        'category' => $category
      );

      // Push to "data"
      array_push($cat_arr['data'], $cat_item);
    }

    // Turn to JSON & output
    echo json_encode($cat_arr);
  }
elseif(($_SERVER['REQUEST_METHOD'] === 'GET') & ($id != null)){

  // Get ID
  $category->id = $id;

   // Get category
  $category->read_single();

}


if(($_SERVER['REQUEST_METHOD'] === 'POST') & ($category != null)) {
 
}
elseif(($_SERVER['REQUEST_METHOD'] === 'POST') & ($category = null)) {
  //I don't think we need this error message (confirming in Discord)
  echo json_encode(
    array('message' => 'category_id Not Found')
  );
}


if(($_SERVER['REQUEST_METHOD'] === 'PUT') & ($id != null) ) {
  // Need to handle the error message in the Model as I can check the row count there
  
 }


if(($_SERVER['REQUEST_METHOD'] === 'DELETE') & ($id != null) ) {
 // Need to handle the error message in the Model as I can check the row count there
 
}
