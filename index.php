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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/styles/app.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hacker News</title>
</head>

<body>
  <div class="container">
    <header>
      <h1>Hacker News</h1>
    </header>
    <div class="row">
      <ul>
        <li>
          <div class="sortoptions">Sort posts</div>
        </li>
        <?php if (isset($_SESSION['user'])) :
        ?><li><a href="newpost.php">Create new post</a></li><?php endif; ?>
        <?php if (!isset($_SESSION['user'])) :
        ?><li><a href="login.php">Login</a></li><?php endif; ?>
        <?php if (isset($_SESSION['user'])) :
        ?><li><a href="app/users/logout.php">Logout</a><?php endif; ?>
          </li>
          <?php if (!isset($_SESSION['user'])) :
          ?><li><a href="signup.php">Sign up</a></li><?php endif; ?>
          <?php if (isset($_SESSION['user'])) :
          ?><li><a href="edituser.php">My Account</a><?php endif; ?>
            <?php if (isset($_SESSION['user'])) : ?>
            <li>
              <span class="session">Logged in, <?php echo $_SESSION['user']; ?>!</span>
            </li>
          <?php endif; ?>
          </li>
      </ul>
    </div>
  </div>
  <div class="container-md">
    <div class="dropdown">
      <ul>
        <li><a href="index.php?sort_option=votes">Most popular</a></li>
        <li><a href="index.php?sort_option=time_stamp">Newest posts</a></li>
      </ul>
    </div>
    <?php foreach ($posts as $post) : ?>
      <h2><a href="post.php?id=<?= $post['id']; ?>"><?= $post['title']; ?></a></h2>
      <form id="upvoteButton" action="/app/users/uservote.php" method="POST">
        <input type="hidden" name="id" value="<?= $post['id']; ?>">
        <button type="submit" class="arrowUp">
          <p style="font-size:9px">&#128314;</p>
        </button>
      </form>
      <p class="belowpost">
        <?= $post['votes']; ?> votes | Posted by
        <?= $post['user']; ?> |
        <?= numberOfComments($dbHandler, $post['id']); ?> Comments |
        <?= $post['time_stamp']; ?>
      </p>
      <?php if ($userLoggedIn === true and ($_SESSION['user'] === $post['user'])) {
      ?><span class="editpost"><a href="editpost.php?id=<?= $post['id']; ?>">Edit post</a></span>
    <?php }
    endforeach; ?>
  </div>
  <script src="/assets/scripts/app.js"></script>
</body>

</html>