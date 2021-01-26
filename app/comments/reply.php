<?php

declare(strict_types=1);

// Things that still is not working properly:
// 1. You can reply before comments even exists.
// 2. You can only reply ones.
// 3. Strict types error.





require __DIR__ . '/../autoload.php';

if (isset($_POST['postid'], $_POST['description'])) {
    $postId = trim(filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT));
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS));
    // ADD ID? (Why tho?)
    $id = trim(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));

    $user = $_SESSION['user'];
    $id = $_SESSION['id'];


    $sql = "INSERT INTO replies (posts_id, id, user, description) VALUES (:posts_id, :id, :user, :description)";
    $statement = $dbHandler->prepare($sql);

    $statement->bindParam(':posts_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':user', $user, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);

    $statement->execute();

    header("Location: /../../post.php?id=" . $postId);
}













// if (isset($_POST['id'], $_POST['reply'])) {
//     $reply = filter_var(trim($_POST['reply']), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//     $commentId = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
//     $valid = true;

//     // Insert replies and match with user_id, comment_id
//     $statement = $pdo->prepare('INSERT INTO replies (posts_id, id, user, description)
//     VALUES (:posts_id, :id, :user, :description)');
//     if (!$statement) {
//         $valid = false;
//         $errors = $pdo->errorInfo();
//         $response = [
//             'valid' => $valid,
//             'errors' => $errors
//         ];
//         echo json_encode($response);
//         exit;
//     }

//     $statement->execute([
//         ':user_id' => $_SESSION['user']['id'],
//         ':comment_id' => $commentId,
//         ':reply' => $reply
//     ]);

//     // Get replies
//     $statement = $pdo->prepare('SELECT * FROM replies WHERE id = :id');
//     if (!$statement) {
//         $valid = false;
//         $errors = $pdo->errorInfo();
//         $response = [
//             'valid' => $valid,
//             'errors' => $errors
//         ];
//         echo json_encode($response);
//         exit;
//     }

//     $statement->execute([
//         ':id' => $pdo->lastInsertId()
//     ]);

//     $reply = $statement->fetch(PDO::FETCH_ASSOC);

//     echo json_encode($response);
//     exit;
// }
