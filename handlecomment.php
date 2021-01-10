<?php

require __DIR__ . '/autoload.php';

if (isset($_POST['postid'], $_POST['description'])) {
    $postId = trim(filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT));
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS));
} else {
    echo "Invalid declaration in form<br>";
}

if ($description === '') {
    echo  'The comment field is missing.<br>';
}

$id = NULL;
$user = $_SESSION['user'];
$time_stamp = date("Y-m-d H:i:s");

$sql = "INSERT INTO comments (posts_id, id, user, description, time_stamp) VALUES (:posts_id, :id, :user, :description, :time_stamp)";
$statement = $dbHandler->prepare($sql);

$statement->bindParam(':posts_id', $postId, PDO::PARAM_INT);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->bindParam(':user', $user, PDO::PARAM_STR);
$statement->bindParam(':description', $description, PDO::PARAM_STR);
$statement->bindParam(':time_stamp', $time_stamp, PDO::PARAM_STR);

// insert one row
$statement->execute();

header("Location: post.php?id=" . $postId);

// $redirect;
