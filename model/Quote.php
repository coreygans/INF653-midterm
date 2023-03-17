<?php

class Quote {
     // DB Stuff
     private $conn;
     private $table = 'quotes';
 
     // Properties
     public $id;
     public $quotation;
     public $author;
     public $category;
 
     // Constructor with DB
     public function __construct($db) {
       $this->conn = $db;
     }
 
     // Get quotes
     public function read() {
      // Create query
      $query = '
      SELECT q.id, q.quote, a.author, c.category
              FROM ' . $this->table . ' q
              Inner join authors a ON q.author_id = a.id
              inner join categories c ON q.category_id = c.id
            ORDER BY
              q.id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
 
     // Get Single author
   public function read_single(){
     // Create query
    $query = '
     SELECT q.id, q.quote, a.author, c.category
        FROM ' . $this->table . ' q
        Inner join authors a ON q.author_id = a.id
        inner join categories c ON q.category_id = c.id
        WHERE q.id = ?
        LIMIT 1';
 
       //Prepare statement
       $stmt = $this->conn->prepare($query);
 
       // Bind ID
       $stmt->bindParam(1, $this->id);

       // Execute query
       $stmt->execute();
 
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($row){
        print_r(json_encode($row));
       }
       else{
        echo json_encode(
          array('message' => 'No Quotes Found')
        );
       }
   }

    // Create quote
   public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
    $this->table . '
    (quote, author_id, category_id) VALUES (?,?,?)
    RETURNING *';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);
    

    // Clean data
    $this->quotation = htmlspecialchars(strip_tags($this->quotation));
    $this->author = htmlspecialchars(strip_tags($this->author));
    $this->category = htmlspecialchars(strip_tags($this->category));

    // Bind data
    $stmt-> bindParam(1, $this->quotation);
    $stmt-> bindParam(2, $this->author);
    $stmt-> bindParam(3, $this->category);

        // Execute query
    $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
        print_r(json_encode($row,JSON_FORCE_OBJECT));
        }
    }

 // Update quote

 public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
    quote = ?, author_id = ?, category_id = ?
    WHERE id = ?
    RETURNING *';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

   // Clean data
    $this->quotation = htmlspecialchars(strip_tags($this->quotation));
    $this->author = htmlspecialchars(strip_tags($this->author));
    $this->category = htmlspecialchars(strip_tags($this->category));

    // Bind data
    $stmt-> bindParam(1, $this->quotation);
    $stmt-> bindParam(2, $this->author);
    $stmt-> bindParam(3, $this->category);
    $stmt->bindParam(4, $this->id);

//TODO Need to check to see if the category or author id exists before updating.
// I should be able to leverage the api endpoints to validate this.
  // Execute query
  if($stmt->execute()) {
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
     if($row > 0){
     print_r(json_encode($row));
     }
     else {
       echo json_encode(
         array('message' => 'quote_id Not Found')
       );
     }
   }
   
   else{

   // Print error if something goes wrong
   printf("Error: $s.\n", $stmt->error);

  return false; }

  }


}