<?php

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);

$quotation = $data['quote'] ?? null;
$author = $data['author_id'] ?? null;
$category = $data['category_id'] ?? null;

if (empty($quotation) || empty($author) || empty($category)) {

  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
} elseif (!empty($quotation) && !empty($author) && !empty($category)) {
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');


  $quote->quotation = $quotation;
  $quote->author = $author;
  $quote->category = $category;

  $valid_author = $quote->check_authorid();
  $valid_cat = $quote->check_catid();

  if ($valid_author && $valid_cat) {
    // Create author
    $quote->create();
  } elseif (!$valid_author) {
    echo json_encode(
      array('message' => 'author_id Not Found')
    );
  } elseif (!$valid_cat) {
    echo json_encode(
      array('message' => 'category_id Not Found')
    );
  }
} else {
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
}
