<?php

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);

$quotation = null;
$author = null;
$category = null;

$quotation = $data['quote'];
$author = $data['author_id'];
$category = $data['category_id'];

if(empty($quotation) || empty($author) || empty($category)) {
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
}

elseif(!empty($quotation) && !empty($author) && !empty($category)) {
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
   

  $quote->quotation = $quotation;  
  $quote->author = $author;  
  $quote->category = $category;  


    // Create author
  $quote->create();
 
}
else {
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
}