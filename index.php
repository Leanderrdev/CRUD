<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

require_once "config/Database.php";
require_once "models/Student.php";

$database = new Database();
$db = $database->connect();

$student = new Student($db);

$message = "";

/* INSERT */
if (isset($_POST['submit'])) {
    $student->name = $_POST['name'];
    $student->department = $_POST['department'];
    $student->age = $_POST['age'];
    $student->user_id = $_SESSION['user_id'];

    if ($student->create()) {
        $message = "Data Inserted Successfully";
    }
}

/* UPDATE */
if(isset($_POST['update'])){
    $student->id = $_POST['edit_id'];
    $student->name = $_POST['edit_name'];
    $student->department = $_POST['edit_department'];
    $student->age = $_POST['edit_age'];
    $student->user_id = $_SESSION['user_id'];

    if($student->update($_SESSION['is_admin'])){
        header("Location: index.php");
        exit();
    }
}

$result = $student->read($_SESSION['is_admin'], $_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CRUD</title>
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<header>
    <div class="logo">php</div>
    <h1>CRUD System</h1>
</header>

<main>

<div class="card">

<div class="card-header">
<h2>Students</h2>
<a href="logout.php" class="logout-btn">Logout</a>
</div>

<?php if($message): ?>
<div class="alert"><?= $message ?></div>
<?php endif; ?>

<div class="content">

<div class="form-section">
<h3>Add Student</h3>

<form method="POST">
<label>Name</label>
<input type="text" name="name" required>

<label>Department</label>
<input type="text" name="department" required>

<label>Age</label>
<input type="number" name="age" required>

<div class="buttons">
<button type="submit" name="submit" class="submit-btn">Submit</button>
<button type="reset" class="clear-btn">Clear</button>
</div>
</form>
</div>

<div class="table-section">

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Department</th>
<th>Age</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['department'] ?></td>
<td><?= $row['age'] ?></td>
<td>
<a href="delete.php?id=<?= $row['id'] ?>" class="action-btn delete-link">Delete</a>
</td>
</tr>
<?php endwhile; ?>

</table>

</div>
</div>

</div>

</main>

</body>
</html>