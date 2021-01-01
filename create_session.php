<?php

declare(strict_types=1);

session_start();
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

// Connect to database.

try {
    $dbHandler = new PDO('sqlite:hackernews.db');
    echo "Yay!";
} catch (PDOException $e) {
    die($e->getMessage());
}

// Check if user exists in table users.

$sql = "SELECT password_ FROM users WHERE user=:user";
$statement = $dbHandler->prepare($sql);
$statement->bindValue(':user', $username);
$statement->execute();
// Find way to check if user does not exist.
$password_db = $statement->fetchColumn();

// Check if password is correct. 
// If login information is correct, create loginsession.

if ($password_db === $password) {
    echo "Password is correct" . "<br />";
    $_SESSION['user'] = $username;
} else {
    echo "Password is incorrect" . "<br />";
}
// if (password_verify($password, $password_db)) {
//     unset($password_db);
//     echo "Password =" . $password;
//     $_SESSION['user'] = $username;
// } else {
//     echo $password;
//     echo $password_db;
//     echo "Password is incorrect";
// }

// Redirecting to main page.

header("Location: index.php");
