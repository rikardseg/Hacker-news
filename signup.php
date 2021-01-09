<?php

declare(strict_types=1);

session_start();

if (!isset($_SESSION['error_message'])) {
    $errormessage = "";
    echo "No error";
} else {
    $errormessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
    echo "Error is set";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="signup.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>

<p><?= $errormessage; ?></p>

<body>
    <main>
        <h1>Sign up</h1>
        <form action="handleuser.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="editmode" value="new">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required />
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required />
            <label for="biography">Biography</label>
            <textarea id="biography" name="biography" placeholder="Write something.." style="height:200px"></textarea>
            <label for="avatar_name">Avatar</label>
            <input type="file" name="avatar_name" id="avatar_name" accept=".png, .jpeg" />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
            <label for="confirm_password">Confirm password</label>
            <input type="password" name="confirm_password" id="confirm_password" required />
            <button type="submit">Create account</button>
        </form>
    </main>

</body>

</html>