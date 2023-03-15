<?php

if(empty($_GET['id'])){ 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  // author read query
  $result = $quote->read();

    //Cat array
    $cat_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $cat_item = array(
        'id' => $id,
        'quote' => $quote,
        'author' => $author,
        'category' => $category
      );

      // Push to "data"
      array_push($cat_arr, $cat_item);
    }

    //Turn to JSON & output
    echo json_encode($cat_arr);
  }
elseif($_GET['id'] != null){
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
$id = htmlspecialchars($_GET['id']);
  // Get ID
  $quote->id = $id;

   // Get quote
  $quote->read_single();

}