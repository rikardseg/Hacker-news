<?php

require __DIR__ . '/alwaysload.php';

$redirect = header("Location: index.php");

if (isset($_POST['username'], $_POST['email'], $_POST['biography'], $_POST['avatar_name'], $_POST['password'], $_POST['confirm_password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $biography = trim(filter_var($_POST['biography'], FILTER_SANITIZE_SPECIAL_CHARS));
    $avatar = $_POST['avatar_name'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
} else {
    echo "Invalid declaration in form<br>";
}

if ($username === '') {
    echo  'The username field is missing.<br>';
}

if ($email === '') {
    echo  'The email field is missing.<br>';
}

if ($password === '') {
    echo  'The password field is missing.<br>';
}

if ($password !== $confirmPassword) {
    echo "Passwords does not match";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'The email is not valid email address.';
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// try {
//     $dbHandler = new PDO('sqlite:hackernews.db');
//     echo "Yay!";
// } catch (PDOException $e) {
//     die($e->getMessage());
// }

$sql = "INSERT INTO users (user, e_mail, biography, avatar_name, password_) VALUES (:user, :e_mail, :biography, :avatar_name, :password_)";
$statement = $dbHandler->prepare($sql);

$statement->bindParam(':user', $username);
$statement->bindParam(':e_mail', $email);
$statement->bindParam(':biography', $biography);
$statement->bindParam(':avatar_name', $avatar);
$statement->bindParam(':password_', $hashedPassword);

// insert one row
$statement->execute();

echo "YES";

$redirect;
