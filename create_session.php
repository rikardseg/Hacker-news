<?php

require __DIR__ . '/alwaysload.php';

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
$statement->bindValue(':user', $username);
$statement->execute();
// Find way to check if user does not exist.
$password_db = $statement->fetchColumn();

// Check if password is correct. 
// If login information is correct, create loginsession.
// if ($password_db === $password) {
//     echo "Password is correct" . "<br />";
//     $_SESSION['user'] = $username;
// } else {
//     echo "Password is incorrect" . "<br />";
// }
if (password_verify($password, $password_db)) {
    $_SESSION['user'] = $username;
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
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
