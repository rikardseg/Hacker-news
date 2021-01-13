<?php

require __DIR__ . '/../autoload.php';

$redirect = header("Location: /../../index.php");

if (isset($_POST['username'], $_POST['email'], $_POST['biography'], $_FILES['avatar_name'], $_POST['password'], $_POST['confirm_password'], $_POST['editmode'])) {
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $biography = trim(filter_var($_POST['biography'], FILTER_SANITIZE_STRING));
    $avatar = trim(filter_var($_FILES['avatar_name']['name'], FILTER_SANITIZE_STRING));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $editmode = $_POST['editmode'];
} else {
    $_SESSION['error_message'] = "Invalid declaration in form";
    if ($editmode === 'edit') {
        header("Location: /../../edituser.php");
        exit;
    }
    header("Location: /../../signup.php");
    exit;
}

if ($username === '') {
    $_SESSION['error_message'] = "The username field is missing";
    if ($editmode === 'edit') {
        header("Location: /../../edituser.php");
        exit;
    }
    header("Location: /../../signup.php");
    exit;
}

if ($email === '') {
    $_SESSION['error_message'] = "The email field is missing.";
    if ($editmode === 'edit') {
        header("Location: /../../edituser.php");
        exit;
    }
    header("Location: /../../signup.php");
    exit;
}

if ($password === '') {
    $_SESSION['error_message'] = "The password field is missing.";
    if ($editmode === 'edit') {
        header("Location: /../../edituser.php");
        exit;
    }
    header("Location: /../../signup.php");
    exit;
}

if ($password !== $confirmPassword) {
    $_SESSION['error_message'] = "Passwords does not match";
    if ($editmode === 'edit') {
        header("Location: /../../edituser.php");
        exit;
    }
    header("Location: /../../signup.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'The email is not valid email address.';
}

if (isset($_FILES['avatar_name'])) {
    $destination = __DIR__ . '/../../avatars/' . $avatar;
    $avatarTemp = $_FILES['avatar_name']['tmp_name'];
    move_uploaded_file($avatarTemp, $destination);
}

$hashedPassword = trim(password_hash($password, PASSWORD_DEFAULT));

if ($editmode === "new") {
    // Check if user alreday exist and if so, return with error message set
    $sql = "SELECT user FROM users WHERE user=:user";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':user', $username, PDO::PARAM_STR);
    $statement->execute();
    $userDb = $statement->fetchColumn();
    if ($userDb === $username) {
        $_SESSION['error_message'] = "User already exist! Try again and use another username";
        header("Location: /../../signup.php");
        exit;
    }
    //Insert one row.
    $sql = "INSERT INTO users (user, e_mail, biography, avatar_name, password_) VALUES (:user, :e_mail, :biography, :avatar_name, :password_)";
    $statement = $dbHandler->prepare($sql);

    $statement->bindParam(':user', $username, PDO::PARAM_STR);
    $statement->bindParam(':e_mail', $email, PDO::PARAM_STR);
    $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
    $statement->bindParam(':avatar_name', $avatar, PDO::PARAM_STR);
    $statement->bindParam(':password_', $hashedPassword, PDO::PARAM_STR);

    $statement->execute();
} else if ($editmode === "edit") {
    //Update one row.
    $sql = "UPDATE users SET user=:user, e_mail=:e_mail, biography=:biography, avatar_name=:avatar_name, password_=:password_ WHERE user=:user";
    $statement = $dbHandler->prepare($sql);

    $statement->bindParam(':user', $username, PDO::PARAM_STR);
    $statement->bindParam(':e_mail', $email, PDO::PARAM_STR);
    $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
    $statement->bindParam(':avatar_name', $avatar, PDO::PARAM_STR);
    $statement->bindParam(':password_', $hashedPassword, PDO::PARAM_STR);
    $statement->execute();
}

$redirect;
