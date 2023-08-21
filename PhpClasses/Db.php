<?php
  namespace MyApp;
  use PDO;
  
  class Db {
    protected $connection;

    public function __construct() {
      // Connect to the database
      $this->connection = new PDO('mysql:host=127.0.0.1;dbname=todoapp_php_db',"root", "");
    }
    
    public function query($query) {
      return $this->connection->query($query);
    }

    public function prepare($query) {
      return $this->connection->prepare($query);
    }
    
    public function close() {
        // close the connection
        $this->connection = null;
    }
  }
?>