<?php

if($_GET['author_id'] != null){
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
  $author = htmlspecialchars($_GET['author_id']);

    // Get ID
    $quote->author = $author;
    
  
     // Get quotes
     $result = $quote->read_quotes_author();
      //Quote array
      $quo_arr = array();

      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
        $quo_item = array(
          'id' => $id,
          'quote' => $quote,
          'author' => $author,
          'category' => $category
        );
  
        // Push to "data"
        array_push($quo_arr, $quo_item);
      }
  
      //Turn to JSON & output
      echo json_encode($quo_arr);
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


elseif(empty($_GET['id'] && !empty($_GET['author_id']))){ 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
    
      // read query
      $result = $quote->read();
    
        //Quote array
        $quo_arr = array();
    
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
    
          $quo_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
          );
    
          // Push to "data"
          array_push($quo_arr, $quo_item);
        }
    
        //Turn to JSON & output
        echo json_encode($quo_arr);
      }
  else {
    echo json_encode(
      array('message' => 'No Quotes Found')
    );
  }