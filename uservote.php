<?php

require __DIR__ . '/check_session.php';

if (isset($_POST['id'])) {
    $postsId = $_POST['id'];
} else {
    $_SESSION['error_message'] = "Invalid declaration in form";
    echo "error";
}
echo $postsId;

$user = $_SESSION['user'];

echo $user;

updateVotes($dbHandler, $user, $postsId);

header("Location: index.php");
