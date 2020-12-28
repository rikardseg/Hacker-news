<?php if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['biography'], $_POST['avatar_name'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $biography = trim(filter_var($_POST['biography'], FILTER_SANITIZE_SPECIAL_CHARS));
    $avatar = $_POST['avatar_name'];
} else {
    echo "Invalid declaration in form<br>";
}

if ($username === '') {
    echo  'The username field is missing.<br>';
}

if ($email === '') {
    echo  'The email field is missing.<br>';
}

if ($password === '') {
    echo  'The password field is missing.<br>';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'The email is not valid email address.';
}

print_r(PDO::getAvailableDrivers());

try {
    $dbHandler = new PDO('sqlite:hackernews.db');
    echo "Yay!";
} catch (PDOException $e) {
    die($e->getMessage());
}
