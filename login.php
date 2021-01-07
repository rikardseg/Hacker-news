<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="login.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
</head>

<body>
  <main>
    <h1>Login</h1>
    <form action="create_session.php" method="post">
      <label for="username">Username</label>
      <input type="username" name="username" id="username" required />
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required />
      <button type="submit">Login</button>
    </form>
  </main>
</body>

</html>