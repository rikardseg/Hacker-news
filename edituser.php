<?php

declare(strict_types=1);

require __DIR__ . '/check_session.php';

if (!isset($_SESSION['error_message'])) {
    $errormessage = "";
    echo "No error";
} else {
    $errormessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
    echo "Error is set";
}

// Check if user exists in table users.
$sql = "SELECT * FROM users WHERE user=:user";
$statement = $dbHandler->prepare($sql);
$statement->bindValue(':user', $username);
$statement->execute();
// Find way to check if user does not exist.
$password_db = $statement->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="signup.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
</head>

<p><?= $errormessage; ?></p>

<body>
    <main>
        <h1>My account</h1>
        <form action="handleuser.php" method="post">
            <label for="username">Username</label>
            <input type="username" name="username" id="username" />
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" />
            <label for="biography">Biography</label>
            <textarea id="biography" name="biography" placeholder="Write something.." style="height:200px"></textarea>
            <label for="avatar_name">Avatar name</label>
            <input type="file" name="avatar_name" id="avatar_name" />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
            <label for="confirm_password">Confirm password</label>
            <input type="password" name="confirm_password" id="confirm_password" />
            <button type="submit">Save changes</button>
        </form>
    </main>

</body>

</html>