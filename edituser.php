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
$user = $_SESSION['user'];
$sql = "SELECT * FROM users WHERE user=:user";
$statement = $dbHandler->prepare($sql);
$statement->bindParam(':user', $user, PDO::PARAM_STR);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) :
    $username = $user['user'];
    $email = $user['e_mail'];
    $biography = $user['biography'];
    $avatar = $user['avatar_name'];

endforeach;

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
        <form action="handleuser.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="editmode" value="edit">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $username; ?>" readonly />
            <label for=" email">E-mail</label>
            <input type="email" name="email" id="email" value="<?= $email; ?>" />
            <label for="biography">Biography</label>
            <textarea id="biography" name="biography" style="height:200px"><?= $biography; ?></textarea>
            <label for="avatar_name">Avatar name</label>
            <input type="file" name="avatar_name" id="avatar_name" value="<?= $avatar; ?>" />
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" />
            <label for="confirm_password">Confirm new password</label>
            <input type="password" name="confirm_password" id="confirm_password" />
            <button type="submit">Save changes</button>
        </form>
    </main>

</body>

</html>