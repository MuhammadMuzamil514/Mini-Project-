<?php
namespace App\Config;
class Database {
    private $host = "localhost";
    private $db_name = "authdb";
    private $username="root";
    private $password="";
public $conn ;


public function __construct(){
 $this->conn = null;
 try {
  $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
  // set the PDO error mode to exception
  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $this->ensurePasswordColumnCanStoreHashes();

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

}

private function ensurePasswordColumnCanStoreHashes(): void {
 try {
  $this->conn->exec("ALTER TABLE users MODIFY password VARCHAR(255) NOT NULL");
 } catch (PDOException $e) {
  // Ignore schema changes when the column already matches or the table cannot be altered.
 }
}
}
?>