<?php

$redirect = header("Location: index.php");

session_start();

if (isset($_POST['title'], $_POST['description'], $_POST['link'])) {
    $title = $_POST['title'];
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS));
    $link = $_POST['link'];
} else {
    echo "Invalid declaration in form<br>";
}

if ($title === '') {
    echo  'The title field is missing.<br>';
}

if ($description === '') {
    echo  'The description field is missing.<br>';
}

try {
    $dbHandler = new PDO('sqlite:hackernews.db');
    echo "Yay!";
} catch (PDOException $e) {
    die($e->getMessage());
}

$id = rand();
$user = $_SESSION['user'];
$votes = 0;
$time_stamp = date("Y-m-d H:i:s");

$sql = "INSERT INTO posts (id, user, title, description, link, votes, time_stamp) VALUES (:id, :user, :title, :description, :link, :votes, :time_stamp)";
$statement = $dbHandler->prepare($sql);

$statement->bindParam(':id', $id);
$statement->bindParam(':user', $user);
$statement->bindParam(':title', $title);
$statement->bindParam(':description', $description);
$statement->bindParam(':link', $link);
$statement->bindParam(':votes', $votes);
$statement->bindParam(':time_stamp', $time_stamp);

// insert one row
$statement->execute();

echo "YES";

$redirect;
