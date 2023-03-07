<?php 
  class Database {
    // DB Params
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    function __construct() {

        $this->host = getenv('MTHOST');
        $this->db_name = getenv('MTNAME');
        $this->username = getenv('MTUSERNAME');
        $this->password = getenv('MTPASSWORD');
    }


    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('pgsql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }