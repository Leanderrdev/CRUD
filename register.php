<?php
require_once "config/Database.php";
require_once "models/User.php";

$db = (new Database())->connect();
$user = new User($db);

$message = "";

if(isset($_POST['register'])){

    $user->username = trim($_POST['username']);
    $user->password = $_POST['password'];

    // Always non-admin
    $user->is_admin = 0;

    // OPTIONAL: validate email format
    if(!filter_var($user->username, FILTER_VALIDATE_EMAIL)){
        $message = "Please enter a valid email.";
    }
    elseif(strlen($user->password) < 6){
        $message = "Password must be at least 6 characters.";
    }
    elseif($user->userExists()){
        $message = "Username already exists!";
    }
    else{
        if($user->register()){
            $message = "Registered successfully! You can now login.";
        } else {
            $message = "Something went wrong.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<header>
    <div class="logo">php</div>
    <h1>Register</h1>
</header>

<div class="auth-container">
<div class="auth-card">

<h2>Create Account</h2>

<form method="POST">
<input type="text" name="username" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="register" class="submit-btn">Register</button>
</form>

<?php if($message): ?>
<p class="alert"><?= $message ?></p>
<?php endif; ?>

<div class="auth-links">
<a href="login.php">Already have an account? Login</a>
</div>

</div>
</div>

</body>
</html>