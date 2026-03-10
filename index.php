<?php

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

    if($student->update()){
        header("Location: index.php");
        exit();
    }

}

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
</div>

<?php if($message): ?>
<div class="alert"><?php echo $message; ?></div>
<?php endif; ?>

<div class="content">

<!-- CREATE FORM -->
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

<!-- EDIT MODAL -->
<div id="editModal" class="modal">

<div class="modal-content">

<h2>Edit Student</h2>

<form method="POST">

<input type="hidden" name="edit_id" id="edit_id">

<label>Name</label>
<input type="text" name="edit_name" id="edit_name" required>

<label>Department</label>
<input type="text" name="edit_department" id="edit_department" required>

<label>Age</label>
<input type="number" name="edit_age" id="edit_age" required>

<div class="buttons">
<button type="submit" name="update" class="submit-btn">Update</button>
<button type="button" id="closeModal" class="clear-btn">Cancel</button>
</div>

</form>

</div>

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

<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['department'] ?></td>
<td><?= $row['age'] ?></td>

<td>

<button
class="edit-btn action-btn"
data-id="<?= $row['id'] ?>"
data-name="<?= $row['name'] ?>"
data-department="<?= $row['department'] ?>"
data-age="<?= $row['age'] ?>"
>
Edit
</button>

<a href="delete.php?id=<?= $row['id'] ?>" class="action-btn">Delete</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>
</div>

</main>

<script src="assets/script.js"></script>

</body>
</html>