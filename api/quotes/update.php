<?php

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json, true);

$id = null;
$quotation = null;
$author = null;
$category = null;

$id = $data['id'];
$quotation = $data['quote'];
$author = $data['author_id'];
$category = $data['category_id'];

if (empty($id) || !is_int($id) || empty($quotation) || empty($author) || !is_int($author) || empty($category) || !is_int($category)) {
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
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

  // Create author
  $quote->update();
} else {
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  echo json_encode(
    array('message' => 'Missing Required Parameters')
  );
}
