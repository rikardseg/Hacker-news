<?php

require __DIR__ . '/autoload.php';

// Check if session variable is set and exist
if (!isset($_SESSION['user'])) {
    // Session not initiated => User is redirected to start page 
    header("Location: index.php");
}
