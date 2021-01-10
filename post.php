<?php

require __DIR__ . '/autoload.php';

if (!isset($_SESSION['error_message'])) {
    $errormessage = "";
} else {
    $errormessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE id = :id";
$statement = $dbHandler->prepare($sql);
$statement->bindParam(":id", $id, PDO::PARAM_INT);
$statement->execute();

$postRow = $statement->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM comments WHERE posts_id=:posts_id";
$statement = $dbHandler->query($sql);
$statement->bindParam(":posts_id", $id, PDO::PARAM_INT);
$statement->execute();

$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="post.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>

<body>
    <?php foreach ($postRow as $post) : ?>
        <h2><?= $post['title'] ?></h2>
        <p><?= $post['description'] ?></p>
        <a href="<?= $post['link'] ?>">This is link</a>
    <?php
    endforeach; ?>
    <p class="errormessage"><?= $errormessage; ?></p>
    <form action="handlecomment.php" method="post">
        <label for="postid"></label>
        <input hidden type="integer" value="<?= $post['id'] ?>" id="postid" name="postid">
        <label for="description">Write comment</label>
        <textarea id="description" name="description" placeholder="Write something.." style="height:200px" required></textarea>
        <button type="submit">Add comment</button>
    </form>

    <?php foreach ($comments as $comment) :
    ?><div>
            <em><?= $comment['user']; ?> <?= $comment['time_stamp']; ?></em>
            <?php if ($_SESSION['user'] === $comment['user']) {
            ?><p class="editcomment"><a href="comment.php?id=<?= $comment['id']; ?>">Edit</a></p>
            <?php
            } ?><p><?= $comment['description'];
                endforeach; ?>
            </p>
        </div>
</body>

</html>