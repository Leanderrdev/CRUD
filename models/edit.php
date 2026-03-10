<?php

require_once "config/Database.php";
require_once "models/Student.php";

$database = new Database();
$db = $database->connect();

$student = new Student($db);

/* GET ID */

$student->id = $_GET['id'] ?? die("No ID found");

/* LOAD RECORD */

$student->readSingle();

/* UPDATE RECORD */

$message = "";

if(isset($_POST['update'])){

    $student->name = $_POST['name'];
    $student->department = $_POST['department'];
    $student->age = $_POST['age'];

    if($student->update()){
        $message = "Record Updated Successfully";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Student</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<header>
<div class="logo">php</div>
<h1>Edit Record</h1>
</header>

<main>

<div class="card">

<h2>Edit Student</h2>

<?php if($message): ?>
<div class="alert"><?php echo $message; ?></div>
<?php endif; ?>

<form method="POST">

<label>Name</label>
<input type="text" name="name" value="<?php echo $student->name ?>" required>

<label>Department</label>
<input type="text" name="department" value="<?php echo $student->department ?>" required>

<label>Age</label>
<input type="number" name="age" value="<?php echo $student->age ?>" required>

<div class="buttons">

<button type="submit" name="update" class="submit-btn">
Update
</button>

<a href="index.php" class="clear-btn">
Cancel
</a>

</div>

</form>

</div>

</main>

</body>

</html>