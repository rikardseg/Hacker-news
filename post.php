<?php

require __DIR__ . '/alwaysload.php';

$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE id = :id";
$statement = $dbHandler->prepare($sql);
$statement->bindParam(":id", $id);
$statement->execute();

$postId = $statement->fetchAll(PDO::FETCH_ASSOC);
//dtata from db 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($postId as $post) : ?>
        <h2><?= $post['title'] ?></h2>
        <p><?= $post['description'] ?></p>
        <a href="<?= $post['link'] ?>">This is link</a>
    <?php
    endforeach; ?>

</body>

</html>