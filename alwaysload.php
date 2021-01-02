<?php

declare(strict_types=1);

session_start();

// require __DIR__ . '/functions.php';

//Connect to database.

try {
    $dbHandler = new PDO('sqlite:hackernews.db');
} catch (PDOException $e) {
    die($e->getMessage());
}
