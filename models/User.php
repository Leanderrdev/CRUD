<?php

class User {

    private $conn;
    private $table = "users";

    public $id;
    public $username;
    public $password;
    public $is_admin;

    public function __construct($db){
        $this->conn = $db;
    }

    /* CHECK IF USER EXISTS */
    public function userExists(){

        $query = "SELECT id FROM " . $this->table . " 
                  WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    /* REGISTER USER */
    public function register(){

        try {

            $query = "INSERT INTO " . $this->table . "
            (username, password, is_admin)
            VALUES (:username, :password, :is_admin)";

            $stmt = $this->conn->prepare($query);

            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":is_admin", $this->is_admin);

            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    /* LOGIN */
    public function login(){

        $query = "SELECT * FROM " . $this->table . " 
                  WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row && password_verify($this->password, $row['password'])){
            return $row;
        }

        return false;
    }
}