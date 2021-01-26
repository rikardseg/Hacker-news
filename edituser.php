<?php

declare(strict_types=1);

require __DIR__ . '/app/check_session.php';

if (!isset($_SESSION['error_message'])) {
    $errormessage = "";
} else {
    $errormessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styles/form.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
</head>

<body>
    <div class="formcontainer">
        <h1>My account</h1>
        <p class="errorcontainer"><?= $errormessage; ?></p>
        <form action="/app/users/handleuser.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="editmode" value="edit">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $username; ?>" readonly />
            <label for=" email">E-mail</label>
            <input type="email" name="email" id="email" value="<?= $email; ?>" />
            <label for="biography">Biography</label>
            <textarea id="biography" name="biography" style="height:200px"><?= $biography; ?></textarea>
            <label for="avatar_name">Avatar</label>
            <img src="/avatars/<?= $avatar; ?>" alt="">
            <input type="file" name="avatar_name" id="avatar_name" value="<?= $avatar; ?>" />
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" />
            <label for="confirm_password">Confirm new password</label>
            <input type="password" name="confirm_password" id="confirm_password" />
            <button type="submit" class="btn">Save changes</button>


        </form>

        <form class="delete-account" action="app/users/deleteacc.php" method="post">
            <button type="delete-account" class="delete-account" name="delete-account">Delete</button>
        </form>


        <!-- <form class="user-settings" action="app/users/deleteacc.php" method="post">
            <label class="delete-account-label text-info hidden" for="delete-button">
                Please comfirm that you want to delete your account. <br>
                Your posts, comments and upvotes will be deleted as well.
            </label>
            <br>
            <button type="submit" class="btn btn-danger delete-account-real hidden" name="delete-button">Delete Account</button>
        </form>
        <button type="button" class="btn btn-danger delete-account">Delete Account</button>
        <button type="button" class="btn btn-success cancel-button hidden">Cancel</button>
        <div class="pb-5"></div> -->


</body>

</html>
