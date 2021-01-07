<?php

require __DIR__ . '/alwaysload.php';

$redirect = header("Location: index.php");

if (isset($_POST['username'], $_POST['email'], $_POST['biography'], $_FILES['avatar_name'], $_POST['password'], $_POST['confirm_password'], $_POST['editmode'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $biography = trim(filter_var($_POST['biography'], FILTER_SANITIZE_SPECIAL_CHARS));
    $avatar = $_FILES['avatar_name']['name'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $editmode = $_POST['editmode'];
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

if (isset($_FILES['avatar_name'])) {
    $destination = __DIR__ . '/avatars/' . $avatar;
    $avatarTemp = $_FILES['avatar_name']['tmp_name'];
    move_uploaded_file($avatarTemp, $destination);
    // move_uploaded_file($_FILES['avatar_name']['tmp_name'], __DIR__ . '/avatars/');
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// try {
//     $dbHandler = new PDO('sqlite:hackernews.db');
//     echo "Yay!";
// } catch (PDOException $e) {
//     die($e->getMessage());
// }

if ($editmode === "new") {
    //Insert one row.
    $sql = "INSERT INTO users (user, e_mail, biography, avatar_name, password_) VALUES (:user, :e_mail, :biography, :avatar_name, :password_)";
    $statement = $dbHandler->prepare($sql);

    $statement->bindParam(':user', $username);
    $statement->bindParam(':e_mail', $email);
    $statement->bindParam(':biography', $biography);
    $statement->bindParam(':avatar_name', $avatar);
    $statement->bindParam(':password_', $hashedPassword);

    $statement->execute();
} else if ($editmode === "edit") {
    //Update one row.
    $sql = "UPDATE users SET user=:user, e_mail=:e_mail, biography=:biography, avatar_name=:avatar_name, password_=:password_ WHERE user=:user";
    $statement = $dbHandler->prepare($sql);

    $statement->bindParam(':user', $username);
    $statement->bindParam(':e_mail', $email);
    $statement->bindParam(':biography', $biography);
    $statement->bindParam(':avatar_name', $avatar);
    $statement->bindParam(':password_', $hashedPassword);
    $statement->execute();
}

echo "Efter execute av UPDATE" . "<br />";
echo "YES";

$redirect;
