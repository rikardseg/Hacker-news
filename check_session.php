<?php

require __DIR__ . '/alwaysload.php';

// Check if session variable is set and exist
if (!isset($_SESSION['user'])) {
    // Session not initiated => User is redirected to start page 
    echo "User not logged in <br>";
    header("Location: index.php");
} else {
    echo "User logged in <br>";
    echo "_SESSION[user_id] = " . $_SESSION['user'] . "<br>";
}
