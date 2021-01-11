<?php

require __DIR__ . '/app/autoload.php';

$sortOption = "";
$userLoggedIn;

if (isset($_GET['sort_option'])) {
  $sortOption = $_GET['sort_option'];
}

if (!isset($_SESSION['user'])) {
  $userLoggedIn = false;
} else {
  $userLoggedIn = true;
}

// Fetch all records in table posts and store them in an array; sort according to $sort_order
if ($sortOption === "time_stamp") {
  $sql = "SELECT * FROM posts ORDER BY time_stamp DESC";
} else if ($sortOption === "votes") {
  $sql = "SELECT * FROM posts ORDER BY votes DESC";
} else {
  $sql = "SELECT * FROM posts";
}
// Fetch all records in table posts and store them in an array
$statement = $dbHandler->query($sql);
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="/assets/styles/app.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hacker News</title>
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
    <?php if (isset($_SESSION['user'])) :
    ?><li><a href="newpost.php">Create new post</a></li><?php endif; ?>
    <li><a href="index.php?sort_option=votes">Most popular</a></li>
    <li><a href="index.php?sort_option=time_stamp">Newest posts</a></li>
    <?php if (!isset($_SESSION['user'])) :
    ?><li><a href="login.php">Login</a></li><?php endif; ?>
    <?php if (isset($_SESSION['user'])) :
    ?><li><a href="app/users/logout.php">Logout</a><?php endif; ?>
      </li>
      <?php if (!isset($_SESSION['user'])) :
      ?><li><a href="signup.php">Sign up</a></li><?php endif; ?>
      <?php if (isset($_SESSION['user'])) :
      ?><li><a href="edituser.php">My Account</a><?php endif; ?>
        </li>
  </ul>
  <?php foreach ($posts as $post) :
  ?>
    <h2><a href="post.php?id=<?= $post['id']; ?>"><?= $post['title']; ?></a></h2>
    <form class="upvoteButton" action="/app/users/uservote.php" method="POST">
      <input type="hidden" name="id" value="<?= $post['id']; ?>">
      <button type="submit">
        <p style="font-size:8px">&#128314;</p>
      </button>
    </form>
    <?= $post['votes']; ?> votes | Posted by
    <?= $post['user']; ?>
    <?= numberOfComments($dbHandler, $post['id']); ?> Comments
    <?= $post['time_stamp'];
    if ($userLoggedIn === true and ($_SESSION['user'] === $post['user'])) {
    ?><p class="editpost"><a href="editpost.php?id=<?= $post['id']; ?>">Edit</a></p>
  <?php
    }
  endforeach; ?>
  <script src="/assets/scripts/script.js"></script>
</body>

</html>