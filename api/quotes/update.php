<?php

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);


$id = $data['id'] ?? null;
$quotation = $data['quote'] ?? null;
$author = $data['author_id'] ?? null;
$category = $data['category_id'] ?? null;

if (empty($id) || !is_int($id) || empty($quotation) || empty($author) || !is_int($author) || empty($category) || !is_int($category)) {
  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
} elseif (!empty($id) || is_int($id) || !empty($quotation) || !empty($author) || is_int($author) || !empty($category) || is_int($category)) {
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  $quote->id = $id;
  $quote->quotation = $quotation;
  $quote->author = $author;
  $quote->category = $category;

  $valid_author = $quote->check_authorid();

  if ($valid_author) {
    // Update author
    $quote->update();
  } else {
    echo json_encode(
      array('message' => 'author_id Not Found')
    );
  }

} else {
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
}
