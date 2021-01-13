<?php

declare(strict_types=1);

require __DIR__ . '/app/check_session.php';

$id = $_GET['id'];

$sql = "SELECT * FROM comments WHERE id = :id";
$statement = $dbHandler->prepare($sql);
$statement->bindParam(":id", $id, PDO::PARAM_INT);
$statement->execute();

$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!$comments) {
    header("location: /");
    exit;
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styles/form.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment</title>
</head>

<body>
    <div class="formcontainer">
        <form action="/app/comments/editcomment.php" method="post">
            <button type="submit" name="return" class="btn">Back to post</button>
            <button type="submit" class="btn" name="delete" onclick="if (!confirm('Are you sure?')) { return false }">Delete comment</button>
            <input hidden type="integer" value="<?= $commentId; ?>" id="commentid" name="commentid">
            <input hidden type="integer" value="<?= $postId; ?>" id="postid" name="postid">
            <label class="comment" for="description">Comment</label>
            <textarea id="description" name="description" placeholder="Write something.." style="height:200px" required><?= $description; ?></textarea>
            <button type="submit" name="submit" class="btn">Save comment</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>

</html>