<?php

class Student {

    private $conn;
    private $table = "students";

    public $id;
    public $name;
    public $department;
    public $age;

    public function __construct($db){
        $this->conn = $db;
    }

    // CREATE
    public function create(){

        $query = "INSERT INTO " . $this->table . "
        SET name=:name, department=:department, age=:age";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":age", $this->age);

        return $stmt->execute();
    }

    // READ
    public function read(){

        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // UPDATE
    public function update(){

        $query = "UPDATE " . $this->table . "
        SET name=:name, department=:department, age=:age
        WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // DELETE
    public function delete(){

        $query = "DELETE FROM " . $this->table . " WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();

        
    }

}