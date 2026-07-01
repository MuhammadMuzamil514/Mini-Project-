<?php
namespace App\Models;
use App\Config\Database;
use PDO;

class user extends Database{
    private $table_name="users";
    public $Id;
    public $name;
    public $email;
    public $password;
 public function __construct() {
        parent::__construct(); 
    }
     public function register(){
    $this->password= password_hash($this->password, PASSWORD_DEFAULT);
         $check_query = "SELECT id FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
         $check_stmt = $this->conn->prepare($check_query);
         $check_stmt->bindvalue(':email', $this->email);
         $check_stmt->execute();

         if ($check_stmt->fetch(PDO::FETCH_ASSOC) ?: false) {
          $query = "UPDATE " . $this->table_name . " SET name = :name, password = :password WHERE email = :email";
         } else {
          $query = "INSERT INTO " . $this->table_name . " (name, email, password) VALUES (:name, :email, :password)";
         }

     $stmt = $this->conn->prepare($query);
     $stmt->bindvalue(':name', $this->name);
     $stmt->bindvalue(':email', $this->email);
     $stmt->bindvalue(':password', $this->password);

         return $stmt->execute();
        
       }

       public function login(){

       $query = "select * from " . $this->table_name . " where email = :email order by id desc limit 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindvalue(':email', $this->email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

       $is_password_valid = false;

       if ($row) {
        $is_password_valid = password_verify($this->password, $row['password']);

        if (!$is_password_valid && hash_equals((string) $row['password'], (string) $this->password)) {
            $is_password_valid = true;

            $update_query = "UPDATE " . $this->table_name . " SET password = :password WHERE id = :id";
            $update_stmt = $this->conn->prepare($update_query);
            $update_stmt->bindvalue(':password', password_hash($this->password, PASSWORD_DEFAULT));
            $update_stmt->bindvalue(':id', $row['id']);
            $update_stmt->execute();
        }
       }

       if($row && $is_password_valid){ 
        $user_id = $row['id'] ?? $row['Id'] ?? $row['ID'] ?? null;
        $this->Id = $user_id;
        $this->name = $row['name'];
        return true; 
    } else { 
        return false; 
    } 
}

}
       
       









