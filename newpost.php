<?php

declare(strict_types=1);

require __DIR__ . '/app/check_session.php';

if (!isset($_SESSION['error_message'])) {
    $errormessage = "";
} else {
    $errormessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styles/form.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New post</title>
</head>

<body>
    <div class="formcontainer">
        <h1>New post</h1>
        <p class="errormessage"><?= $errormessage; ?></p>
        <form action="/app/posts/handlepost.php" method="post">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required />
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Write something.." style="height:200px" required></textarea>
            <label for="Link">Link</label>
            <input type="url" name="link" id="link">
            <button type="submit" class="btn">Create</button>
        </form>
    </div>

</body>

</html>