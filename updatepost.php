<?php

require __DIR__ . '/check_session.php';

if (isset($_POST['postid'], $_POST['title'], $_POST['description'], $_POST['link'])) {
    $id = $_POST['postid'];
    $title = $_POST['title'];
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS));
    $link = $_POST['link'];
} else {
    echo "error";
}

if (isset($_POST['submit'])) {
    $timeStamp = date("Y-m-d H:i:s");

    $sql = "UPDATE posts SET title=:title, description=:description, link=:link, time_stamp=:time_stamp WHERE id=:id";
    $statement = $dbHandler->prepare($sql);

    $statement->bindParam(':id', $id);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':link', $link);
    $statement->bindParam(':time_stamp', $timeStamp);

    $statement->execute();
} else if (isset($_POST['delete'])) {

    $sql = "DELETE FROM posts WHERE id=:id";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $sql = "DELETE FROM comments WHERE posts_id=:posts_id";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':posts_id', $id, PDO::PARAM_INT);
    $statement->execute();
} else {
    echo "Don't know ... <br>";
}

header("Location: index.php");
