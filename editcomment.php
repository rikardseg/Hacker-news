<?php

require __DIR__ . '/check_session.php';

if (isset($_POST['commentid'], $_POST['postid'], $_POST['description'])) {
    $postId = trim(filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT));
    $commentId = trim(filter_var($_POST['commentid'], FILTER_SANITIZE_NUMBER_INT));
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
} else {
    echo "error";
}

if (isset($_POST['submit'])) {

    $timeStamp = date("Y-m-d H:i:s");

    $sql = "UPDATE comments SET description=:description, time_stamp=:time_stamp WHERE id=:id";
    $statement = $dbHandler->prepare($sql);

    $statement->bindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':time_stamp', $timeStamp, PDO::PARAM_STR);
    $statement->execute();
} else if (isset($_POST['delete'])) {

    $sql = "DELETE FROM comments WHERE id=:id";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->execute();
} else {
    echo "Don't know ... <br>";
}

header("Location: post.php?id=" . $postId);
