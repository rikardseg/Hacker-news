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
    $_SESSION['error_message'] = "Invalid declaration in form";
    header("Location: signup.php");
}

if ($username === '') {
    $_SESSION['error_message'] = "The username field is missing";
    header("Location: signup.php");
}

if ($email === '') {
    $_SESSION['error_message'] = "The email field is missing.";
    header("Location: signup.php");
}

if ($password === '') {
    $_SESSION['error_message'] = "The password field is missing.";
    header("Location: signup.php");
}

if ($password !== $confirmPassword) {
    $_SESSION['error_message'] = "Passwords does not match";
    header("Location: signup.php");
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
