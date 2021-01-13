<?php

require __DIR__ . '/../check_session.php';

if (isset($_POST['postid'], $_POST['title'], $_POST['description'], $_POST['link'])) {
    $id = trim(filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT));
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS));
    $link = trim(filter_var($_POST['link'], FILTER_SANITIZE_URL));
} else {
    $_SESSION['error_message'] = "Invalid declaration in form.";
    header("Location: /../../editpost.php");
}

if (isset($_POST['submit'])) {
    $timeStamp = date("Y-m-d H:i:s");

    $sql = "UPDATE posts SET title=:title, description=:description, link=:link, time_stamp=:time_stamp WHERE id=:id";
    $statement = $dbHandler->prepare($sql);

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':link', $link, PDO::PARAM_STR);
    $statement->bindParam(':time_stamp', $timeStamp, PDO::PARAM_STR);

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

    // Remove all records in user_vote thats related to the post_id.
    $sql = "DELETE FROM user_vote WHERE posts_id=:posts_id";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':posts_id', $id, PDO::PARAM_INT);
    $statement->execute();
} else if (isset($_POST['return'])) {
    header("Location: /../../index.php");
}

header("Location: /../../index.php");
