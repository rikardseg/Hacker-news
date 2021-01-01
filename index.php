<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="style.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <?php if (isset($_SESSION['user'])) : ?>
    <p>Logged in, <?php echo $_SESSION['user']; ?>!</p>
  <?php endif; ?>
  <?php if (!isset($_SESSION['user'])) : ?>
    <p>Logged out!</p>
  <?php endif; ?>
  <header>
    <h1>Hacker News</h1>
  </header>
  <ul>
    <li><a href="newpost.php">Create new post</a></li>
    <li><a href="#Most popular">Most popular</a></li>
    <li><a href="#Newest posts">Newest posts</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="logout.php">Logout</a></li>
    <li><a href="signup.php">Sign up</a></li>
  </ul>
  <script src="script.js"></script>
</body>

</html>