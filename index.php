<?php

require __DIR__ . '/alwaysload.php';

$sort_option = "";

if (isset($_GET['sort_option'])) {
  $sort_option = $_GET['sort_option'];
}

// sql statment that selects the number of rows in table posts
$sql = "SELECT COUNT(*) FROM posts";
$statement = $dbHandler->prepare($sql);
$statement->execute();
echo "antal rader: " . $statement->fetchColumn() . "<br />";

// Fetch all records in table posts and store them in an array; sort according to $sort_order
if ($sort_option === "time_stamp") {
  $sql = "SELECT * FROM posts ORDER BY time_stamp DESC";
} else if ($sort_option === "votes") {
  $sql = "SELECT * FROM posts ORDER BY votes DESC";
} else {
  $sql = "SELECT * FROM posts";
}
echo "$sql";
// Fetch all records in table posts and store them in an array
$statement = $dbHandler->query($sql);
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

// foreach ($posts as $post) :
//   echo $post['id'];
//   echo $post['user'];
//   echo $post['title'];
//   echo $post['description'];
//   echo $post['link'];
//   echo $post['votes'];
//   echo $post['time_stamp'];
//   echo "<br />";
// endforeach;

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
    <li><a href="index.php?sort_option=votes">Most popular</a></li>
    <li><a href="index.php?sort_option=time_stamp">Newest posts</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="logout.php">Logout</a></li>
    <li><a href="signup.php">Sign up</a></li>
  </ul>
  <?php foreach ($posts as $post) :
  ?><div>
      <h2><a href="post.php?id=<?= $post['id']; ?>"><?= $post['title']; ?></a></h2>
      <p><?= $post['votes']; ?> Posted by
        <?= $post['user']; ?>
      <?= $post['time_stamp'];
    endforeach; ?>
      </p>
    </div>
    <script src=" script.js"></script>
</body>

</html>