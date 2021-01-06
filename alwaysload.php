<?php

declare(strict_types=1);

require __DIR__ . '/functions.php';

session_start();

//Connect to database.

try {
    $dbHandler = new PDO('sqlite:hackernews.db');
} catch (PDOException $e) {
    die($e->getMessage());
}
