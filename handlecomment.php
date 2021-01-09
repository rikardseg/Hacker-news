<?php

require __DIR__ . '/autoload.php';

if (isset($_POST['postid'], $_POST['description'])) {
    $postId = $_POST['postid'];
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS));
} else {
    echo "Invalid declaration in form<br>";
}

if ($description === '') {
    echo  'The comment field is missing.<br>';
}

$id = rand();
$user = $_SESSION['user'];
$time_stamp = date("Y-m-d H:i:s");

$sql = "INSERT INTO comments (posts_id, id, user, description, time_stamp) VALUES (:posts_id, :id, :user, :description, :time_stamp)";
$statement = $dbHandler->prepare($sql);

$statement->bindParam(':posts_id', $postId);
$statement->bindParam(':id', $id);
$statement->bindParam(':user', $user);
$statement->bindParam(':description', $description);
$statement->bindParam(':time_stamp', $time_stamp);

// insert one row
$statement->execute();

echo "YES";

header("Location: post.php?id=" . $postId);



// $redirect;
