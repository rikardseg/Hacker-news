<?php

require __DIR__ . '/app/autoload.php';

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styles/form.css" />
    <link rel="stylesheet" href="/assets/styles/app.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>

<body>
    <div class="postcontainer">
        <?php foreach ($postRow as $post) : ?>
            <h2><?= $post['title'] ?></h2>
            <p><?= $post['description'] ?></p>
            <span class="linkpost"><a href="<?= $post['link'] ?>"><?= $post['link']; ?></a></span>
        <?php
        endforeach; ?>
    </div>
    <div class="formcontainer">
        <form action="/app/comments/handlecomment.php" method="post">
            <button type="submit" name="return" class="btn">Back to mainpage</button>
            <p class="errormessage"><?= $errormessage; ?></p>
            <label for="postid"></label>
            <input hidden type="integer" value="<?= $post['id'] ?>" id="postid" name="postid">
            <label for="description">Write comment</label>
            <textarea id="description" name="description" placeholder="Write something.." style="height:200px"></textarea>
            <button type="submit" name="submit" class="btn">Add comment</button>
        </form>
    </div>
    <div class="commentcontainer">
        <?php foreach ($comments as $comment) :
        ?><div>
                <em><?= $comment['user']; ?> <?= $comment['time_stamp']; ?></em>
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] === $comment['user']) {
                ?><p class="editcomment"><a href="comment.php?id=<?= $comment['id']; ?>">Edit comment</a></p>
                <?php
                } ?><p><?= $comment['description'];
                    endforeach; ?>
                </p>
            </div>
    </div>
</body>

</html>
