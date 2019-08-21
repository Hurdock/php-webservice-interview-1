<?php 

  class Database {

    private $conn = null;
    private $db_data = array(
      'host' => 'localhost',
      'username' => 'root',
      'password' => '',
      'database' => 'demo'
    );

    public function Connect() {
      $this->conn = null;
      try {
        $this->conn = new PDO(
          'mysql:dbname=' . $this->db_data['database'] . ';' . 
          'host=' . $this->db_data['host'], 
          $this->db_data['username'], 
          $this->db_data['password']
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $err) {
        echo('Connection error: ' . $err->getMessage());
      }
      return $this->conn;
    }
 
    public function existsTable($name) {
      try {
        $result = $this->conn->query("SELECT 1 from $name LIMIT 1");
      } catch (Exception $e) {
        return false;
      }
      return $result !== FALSE;
    }

  }
?>