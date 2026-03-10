<?php

require_once "config/Database.php";
require_once "models/Student.php";

$database = new Database();
$db = $database->connect();

$student = new Student($db);

$student->id = $_GET['id'];

if($student->delete()){
    header("Location: index.php");
}