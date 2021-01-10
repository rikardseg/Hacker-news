<?php

require __DIR__ . '/autoload.php';

// Check if user exists and then login.
// Receiving form data.
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
} else {
    echo "Invalid declaration in form<br>";
}

// Check if username and password is entered.
if ($username === '') {
    echo  'The username field is missing.<br>';
}

if ($password === '') {
    echo  'The password field is missing.<br>';
}

// Check if user exists in table users.
$sql = "SELECT password_ FROM users WHERE user=:user";
$statement = $dbHandler->prepare($sql);
$statement->bindValue(':user', $username, PDO::PARAM_STR);
$statement->execute();

$password_db = $statement->fetchColumn();

// Find way to check if user does not exist.
$sql = "SELECT avatar_name FROM users WHERE user=:user";
$statement = $dbHandler->prepare($sql);
$statement->bindValue(':user', $username);
$statement->execute();

$avatar = $statement->fetchColumn();

// Check if password is correct. 
if (password_verify($password, $password_db)) {
    $_SESSION['user'] = $username;
    $_SESSION['avatar'] = $avatar;
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

// Redirecting to main page.
header("Location: index.php");
