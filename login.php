<?php
session_start();

require_once "config/Database.php";
require_once "models/User.php";

$db = (new Database())->connect();
$user = new User($db);

$message = "";

if(isset($_POST['login'])){
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    $result = $user->login();

    if($result){
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['is_admin'] = $result['is_admin'];

        header("Location: index.php");
        exit();
    } else {
        $message = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<header>
    <div class="logo">php</div>
    <h1>Login</h1>
</header>

<div class="auth-container">
<div class="auth-card">

<h2>Login</h2>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login" class="submit-btn">Login</button>
</form>

<?php if($message): ?>
<p class="alert"><?= $message ?></p>
<?php endif; ?>

<div class="auth-links">
<a href="register.php">Create account</a>
</div>

</div>
</div>

</body>
</html>