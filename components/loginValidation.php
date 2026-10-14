<?php

session_start();
function displayError($message) {
    $_SESSION["error"] = $message;
    header("Location: /pages/login.php");
    exit;
}

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);

$usersJson = $_SERVER["DOCUMENT_ROOT"] . "/data/json/users.json";

if (!file_exists($usersJson)) {
    displayError("No user");
}

$users = json_decode(file_get_contents($usersJson), true);

$found = false;

foreach ($users as $user) {
    if ($user["username"] === $username && password_verify($password, $user["password"])) {
        $found = true;
        $_SESSION["success"] = "Login successful!";
        $_SESSION["user-role"] = "creator";
        $_SESSION["username"] = $username;
        header("Location: /pages/creator.php");
        exit;
    }
}

displayError("Something wrong");
?>