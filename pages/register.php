<?php 

session_start();

if (!empty($_SESSION["success"])) {
    $msg = addslashes($_SESSION["success"]);
    echo "<script>alert('$msg');</script>";
    unset($_SESSION["success"]);
}

if (!empty($_SESSION["error"])) {
    $msg = addslashes($_SESSION["error"]);
    echo "<script>alert('$msg');</script>";
    unset($_SESSION["error"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/master.css">
    <link rel="stylesheet" href="../assets/styles/form.css">
</head>
<form action="/components/registerValidation.php" method="POST" id="regis-form">
    <p class="form-title">Become a Creator on ZouTube</p>

    <input type="text" id="username" name="username" placeholder="Username" required />
    <input type="password" id="password" name="password" placeholder="Password" required />
    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required />

    <button type="submit" id="submit-btn">Register</button>

    <div class="redirect">
        <p>Already have an account?</p>
        <a href="login.php">Login</a>
    </div>

    <a href="/index.php" class="home-btn">Back to Home</a>
</form>
</.>

</html>