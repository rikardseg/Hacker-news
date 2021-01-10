<?php

declare(strict_types=1);

require __DIR__ . '/check_session.php';

$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE id = :id";
$statement = $dbHandler->prepare($sql);
$statement->bindParam(":id", $id, PDO::PARAM_INT);
$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) :
    $title = $post['title'];
    $description = $post['description'];
    $link = $post['link'];
endforeach;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="post.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment</title>
</head>

<body>

    <form action="updatepost.php" method="post">
        <button type="delete" name="delete" onclick="if (!confirm('Are you sure?')) { return false }">Delete post</button>
        <input hidden type="integer" value="<?= $id; ?>" id="postid" name="postid">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $title; ?>" required />
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Write something.." style="height:200px" required><?= $description; ?></textarea>
        <label for="Link">Link</label>
        <input type="url" name="link" id="link" value="<?= $link; ?>">
        <button type="submit" name="submit">Edit post</button>
    </form>
</body>

</html>