<?php

declare(strict_types=1);

require __DIR__ . '/check_session.php';

$id = $_GET['id'];

$sql = "SELECT * FROM comments WHERE id = :id";
$statement = $dbHandler->prepare($sql);
$statement->bindParam(":id", $id, PDO::PARAM_INT);
$statement->execute();

$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($comments as $comment) :
    $postId = $comment['posts_id'];
    $commentId = $comment['id'];
    $user = $comment['user'];
    $description = $comment['description'];
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
    <form action="editcomment.php" method="post">
        <button type="submit" name="return">Return</button>
        <button type="submit" class="delete" name="delete" onclick="if (!confirm('Are you sure?')) { return false }">Delete comment</button>
        <input hidden type="integer" value="<?= $commentId; ?>" id="commentid" name="commentid">
        <input hidden type="integer" value="<?= $postId; ?>" id="postid" name="postid">
        <label for="description">Comment</label>
        <textarea id="description" name="description" placeholder="Write something.." style="height:200px" required><?= $description; ?></textarea>
        <button type="submit" name="submit">Edit comment</button>
    </form>
    <script src="script.js"></script>
</body>

</html>