<?php

require __DIR__ . '/alwaysload.php';
// Remove all info in the session variables
session_unset();
// End the current session
session_destroy();
// Redirect the user to the start page
header('Location: index.php');
