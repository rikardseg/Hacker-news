<?php

declare(strict_types=1);

require __DIR__ . '/functions.php';

// Start the session engines.
session_start();

// Set the default timezone to coordinated universal time.
date_default_timezone_set('UTC');

// Set the default character encoding to UTF-8.
// mb_internal_encoding('UTF-8');

//Connect to database.
try {
    $dbHandler = new PDO('sqlite:hackernews.db');
} catch (PDOException $e) {
    die($e->getMessage());
}
