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

    /* CREATE STUDENT */

    public function create(){

        $query = "INSERT INTO " . $this->table . "
        (name, department, age)
        VALUES
        (:name, :department, :age)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":age", $this->age);

        return $stmt->execute();
    }

    /* READ ALL STUDENTS */

    public function read(){

        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    /* READ SINGLE STUDENT */

    public function readSingle(){

        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){

            $this->name = $row['name'];
            $this->department = $row['department'];
            $this->age = $row['age'];

        }

    }

    /* UPDATE STUDENT */

    public function update(){

        $query = "UPDATE " . $this->table . "
        SET
        name = :name,
        department = :department,
        age = :age
        WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    /* DELETE STUDENT */

    public function delete(){

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

}