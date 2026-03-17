<?php

class Student {

    private $conn;
    private $table = "students";

    public $id;
    public $name;
    public $department;
    public $age;
    public $user_id;

    public function __construct($db){
        $this->conn = $db;
    }

    /* CREATE STUDENT */
    public function create(){

        $query = "INSERT INTO " . $this->table . "
        (name, department, age, user_id)
        VALUES
        (:name, :department, :age, :user_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":user_id", $this->user_id);

        return $stmt->execute();
    }

    /* READ STUDENTS (ROLE BASED) */
    public function read($is_admin, $user_id){

        if($is_admin){
            $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);
        } else {
            $query = "SELECT * FROM " . $this->table . " 
                      WHERE user_id = :user_id 
                      ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":user_id", $user_id);
        }

        $stmt->execute();
        return $stmt;
    }

    /* UPDATE STUDENT */
    public function update($is_admin){

        if($is_admin){
            $query = "UPDATE " . $this->table . "
            SET name = :name, department = :department, age = :age
            WHERE id = :id";
        } else {
            $query = "UPDATE " . $this->table . "
            SET name = :name, department = :department, age = :age
            WHERE id = :id AND user_id = :user_id";
        }

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":id", $this->id);

        if(!$is_admin){
            $stmt->bindParam(":user_id", $this->user_id);
        }

        return $stmt->execute();
    }

    /* DELETE STUDENT */
    public function delete($is_admin){

        if($is_admin){
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        } else {
            $query = "DELETE FROM " . $this->table . " 
                      WHERE id = :id AND user_id = :user_id";
        }

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        if(!$is_admin){
            $stmt->bindParam(":user_id", $this->user_id);
        }

        return $stmt->execute();
    }
}