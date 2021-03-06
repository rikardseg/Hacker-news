<?php

require __DIR__ . '/../autoload.php';

// Check if user exists and then login.
// Receiving form data.
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
} else {
    $_SESSION['error_message'] = "Invalid declaration in form.";
    header("Location: /../../login.php");
}

// Check if username and password is entered.
if ($username === '') {
    $_SESSION['error_message'] = "The username field is missing.";
    header("Location: /../../login.php");
}

if ($password === '') {
    $_SESSION['error_message'] = "The password field is missing.";
    header("Location: /../../login.php");
}

// Check if user exists in table users.
$sql = "SELECT password_ FROM users WHERE user=:user";
$statement = $dbHandler->prepare($sql);
$statement->bindParam(':user', $username, PDO::PARAM_STR);
$statement->execute();

$password_db = $statement->fetchColumn();

// Find way to check if avatar exists.
$sql = "SELECT avatar_name FROM users WHERE user=:user";
$statement = $dbHandler->prepare($sql);
$statement->bindParam(':user', $username);
$statement->execute();

$avatar = $statement->fetchColumn();

// Check if password is correct.
if (password_verify($password, $password_db)) {
    $_SESSION['user'] = $username;
    $_SESSION['avatar'] = $avatar;
    // Redirecting to main page.
    header("Location:/../../index.php");
} else {
    $_SESSION['error_message'] = "Invalid password.";
    header("Location: /../../login.php");
}
