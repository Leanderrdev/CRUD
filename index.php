<?php

require_once "config/Database.php";
require_once "models/Student.php";

$database = new Database();
$db = $database->connect();

$student = new Student($db);

/* INSERT DATA */

$message = "";

if (isset($_POST['submit'])) {

    $student->name = $_POST['name'];
    $student->department = $_POST['department'];
    $student->age = $_POST['age'];

    if ($student->create()) {
        $message = "Data Inserted Successfully";
    }
}

/* FETCH DATA */

$result = $student->read();

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Object-Oriented PHP</title>

<link rel="stylesheet" href="assets/style.css">

</head>

<body>

<header>
<div class="logo">php</div>
<h1>Object-Oriented PHP</h1>
</header>

<main>

<div class="card">

<div class="card-header">
<h2>CRUD with PDO</h2>
<a href="#" class="create-btn">Create New</a>
</div>

<?php if($message): ?>
<div class="alert"><?php echo $message; ?></div>
<?php endif; ?>

<div class="content">

<!-- FORM -->
<div class="form-section">

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

<!-- TABLE -->
<div class="table-section">

<table>

<thead>
<tr>
<th>No</th>
<th>Name</th>
<th>Department</th>
<th>Age</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['department']; ?></td>
<td><?php echo $row['age']; ?></td>

<td>
<a href="edit.php?id=<?php echo $row['id']; ?>" class="action-btn">Edit</a>
<a href="delete.php?id=<?php echo $row['id']; ?>" class="action-btn">Delete</a>
</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>
</div>

</main>

<script src="script.js"></script>

</body>
</html>