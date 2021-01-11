<?php

require __DIR__ . '/../autoload.php';

$redirect = header("Location: /../../index.php");

if (isset($_POST['title'], $_POST['description'], $_POST['link'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS));
    $link = trim(filter_var($_POST['link'], FILTER_SANITIZE_URL));
} else {
    echo "Invalid declaration in form<br>";
}

if ($title === '') {
    echo  'The title field is missing.<br>';
}

if ($description === '') {
    echo  'The description field is missing.<br>';
}

$id = NULL;
$user = $_SESSION['user'];
$votes = 0;
$time_stamp = date("Y-m-d H:i:s");

$sql = "INSERT INTO posts (id, user, title, description, link, votes, time_stamp) VALUES (:id, :user, :title, :description, :link, :votes, :time_stamp)";
$statement = $dbHandler->prepare($sql);

$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->bindParam(':user', $user, PDO::PARAM_STR);
$statement->bindParam(':title', $title, PDO::PARAM_STR);
$statement->bindParam(':description', $description, PDO::PARAM_STR);
$statement->bindParam(':link', $link, PDO::PARAM_STR);
$statement->bindParam(':votes', $votes, PDO::PARAM_INT);
$statement->bindParam(':time_stamp', $time_stamp, PDO::PARAM_STR);

// insert one row
$statement->execute();

$redirect;
