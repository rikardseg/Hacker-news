<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['delete-account'])) {

    // USER (WORKING)
    $user = $_SESSION['user'];
    $statement = $dbHandler->prepare('DELETE FROM users WHERE user=:user');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user', $user, PDO::PARAM_STR);
    $statement->execute();

    // USER_VOTE (WORKING)
    $statement = $dbHandler->prepare('DELETE FROM user_vote WHERE user=:user');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':user', $user, PDO::PARAM_STR);
    $statement->execute();


    // POSTS (Seems to work?)
    // Currently 'removes' ze comments/replies from ze site, but those are still in
    // ze database mmkay?.
    $statement = $dbHandler->prepare('DELETE FROM posts WHERE user=:user');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user', $user, PDO::PARAM_STR);
    $statement->execute();

    //COMMENTS
    $statement = $dbHandler->prepare('DELETE FROM comments WHERE user=:user');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user', $user, PDO::PARAM_STR);
    $statement->execute();

    //REPLIES
    $statement = $dbHandler->prepare('DELETE FROM replies WHERE user=:user');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user', $user, PDO::PARAM_STR);
    $statement->execute();
}


//Redirect
header("Location: /../../index.php?id=");
