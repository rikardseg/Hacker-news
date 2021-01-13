<?php

require __DIR__ . '/app/autoload.php';

if (!isset($_SESSION['error_message'])) {
  $errormessage = "";
} else {
  $errormessage = $_SESSION['error_message'];
  unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/styles/form.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
</head>

<body>
  <div class="container">
    <main>
      <h1>Login</h1>
      <p class="errormessage"><?= $errormessage; ?></p>
      <form action="/app/users/create_session.php" method="post">
        <div class="row mb-1">
          <div class="col">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required />
          </div>
        </div>
        <div class="row mb-4">
          <div class="col">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
          </div>
        </div>
        <div class="row mb-1">
          <div class="col">
            <button type="submit" class="btn">Login</button>
          </div>
        </div>
      </form>
    </main>
  </div>
</body>

</html>