<?php

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

$sql = "INSERT INTO posts (id, user, title, description, link, votes, time_stamp) VALUES (:id, :user, :title, :description, :link, :votes, :time_stamp)";
$statement = $dbHandler->prepare($sql);

$statement->bindParam(':user', $username);
$statement->bindParam(':e_mail', $email);
$statement->bindParam(':biography', $biography);
$statement->bindParam(':avatar_name', $avatar);
$statement->bindParam(':password_', $password);

// insert one row
$statement->execute();

echo "YES";

$redirect;
