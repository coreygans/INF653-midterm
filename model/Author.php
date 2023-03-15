<?php

class Author {
     // DB Stuff
     private $conn;
     private $table = 'authors';
 
     // Properties
     public $id;
     public $name;
 
     // Constructor with DB
     public function __construct($db) {
       $this->conn = $db;
     }
 
     // Get categories
     public function read() {
      // Create query
      $query = 'SELECT
        id,
        author
        FROM
        ' . $this->table . '
      ORDER BY
        id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
 
     // Get Single author
   public function read_single(){
     // Create query
     $query = 'SELECT
           id,
           author
         FROM
           ' . $this->table . '
       WHERE id = ?
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
          array('message' => 'author_id Not Found')
        );
       }
   }
 
   // Create author
   public function create() {
     // Create Query
     $query = 'INSERT INTO ' .
       $this->table . '
     (author) VALUES (?)
     RETURNING *';
 
    // Prepare Statement
    $stmt = $this->conn->prepare($query);
  
    // Clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
  
    // Bind data
    $stmt-> bindParam(1, $this->name);
  
     // Execute query
    $stmt->execute();
 
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($row){
        print_r(json_encode($row,JSON_FORCE_OBJECT));
       }
  }
 
   // Update author
   public function update() {
     // Create Query
     $query = 'UPDATE ' .
       $this->table . '
     SET
     author = ?
       WHERE
       id = ?
       RETURNING *';
 
   // Prepare Statement
   $stmt = $this->conn->prepare($query);
 
   // Clean data
   $this->name = htmlspecialchars(strip_tags($this->name));
   $this->id = htmlspecialchars(strip_tags($this->id));
 
   // Bind data
   $stmt-> bindParam(1, $this->name);
   $stmt-> bindParam(2, $this->id);
 
   // Execute query
   if($stmt->execute()) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row > 0){
      print_r(json_encode($row));
      }
      else {
        echo json_encode(
          array('message' => 'author_id Not Found')
        );
      }
    }
    
    else{
 
    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);
 
   return false; }

   }
 
   // Delete author
   public function delete() {
     // Create query
     $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?';
 
     // Prepare Statement
     $stmt = $this->conn->prepare($query);
 
     // clean data
     $this->id = htmlspecialchars(strip_tags($this->id));
 
     // Bind Data
     $stmt-> bindParam(1, $this->id);
 
     // Execute query
     if($stmt->execute()) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row > 0){
        echo json_encode(
          array('id' => $this->id)
        );
      }
      else {
        echo json_encode(
          array('message' => 'author_id Not Found')
        );
      }



     }
     else{
     // Print error if something goes wrong
     printf("Error: $s.\n", $stmt->error);
 
     return false;
     }
     }
   }
 