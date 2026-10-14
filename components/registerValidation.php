<?php

session_start();
function displayError($message) {
    $_SESSION["error"] = $message;
    header("Location: /pages/register.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $confirmPassword = htmlspecialchars(trim($_POST["confirm-password"]));

    if (empty($username) || empty($password) || empty($confirmPassword)) {
        displayError("Fill all, some empty");
    }

    if ($password !== $confirmPassword) {
        displayError("Passwords don't match");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $userData = [
        "username" => $username,
        "password" => $hashedPassword
    ];

    $usersJson = $_SERVER["DOCUMENT_ROOT"] . "/data/json/users.json";
    
    $users = [];

    $users = json_decode(file_get_contents($usersJson), true);

    $users[] = $userData;

    file_put_contents($usersJson, json_encode($users, JSON_PRETTY_PRINT));
    
    $_SESSION["success"] = "Register Success";
    header("Location: /pages/login.php");
    exit;
}
?>