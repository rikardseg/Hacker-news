<?php

require __DIR__ . '/autoload.php';

$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE id = :id";
$statement = $dbHandler->prepare($sql);
$statement->bindParam(":id", $id);
$statement->execute();

$postRow = $statement->fetchAll(PDO::FETCH_ASSOC);

// Sql statment that selects the number of rows in table comments.
$sql = "SELECT COUNT(*) FROM comments";
$statement = $dbHandler->prepare($sql);
$statement->execute();
echo "antal rader: " . $statement->fetchColumn() . "<br />";

// Fetch all records in table comments and store them in an array
// $sql = "SELECT * FROM comments WHERE posts_id=:posts_id";
// $statement->bindValue(":posts_id", $id);
// $statement = $dbHandler->query($sql);
// $statement->execute();

$sql = "SELECT * FROM comments WHERE posts_id=:posts_id";
$statement = $dbHandler->query($sql);
$statement->bindParam(":posts_id", $id);
$statement->execute();

$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="post.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($postRow as $post) : ?>
        <h2><?= $post['title'] ?></h2>
        <p><?= $post['description'] ?></p>
        <a href="<?= $post['link'] ?>">This is link</a>
    <?php
    endforeach; ?>
    <form action="handlecomment.php" method="post">
        <label for="postid"></label>
        <input hidden type="integer" value="<?= $post['id'] ?>" id="postid" name="postid">
        <label for="description">Write comment</label>
        <textarea id="description" name="description" placeholder="Write something.." style="height:200px"></textarea>
        <button type="submit">Add comment</button>
    </form>

    <?php foreach ($comments as $comment) :
    ?><div>
            <em><?= $comment['user']; ?> <?= $comment['time_stamp']; ?></em>
            <p><?= $comment['description'];
            endforeach; ?>
            </p>
        </div>
</body>

</html>