<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="signup.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <h1>Sign up</h1>
        <form action="handleuser.php" method="post">
            <label for="username">Username</label>
            <input type="username" name="username" id="username" />
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" />
            <label for="biography">Biography</label>
            <textarea id="biography" name="biography" placeholder="Write something.." style="height:200px"></textarea>
            <label for="avatar_name">Avatar name</label>
            <input type="file" name="avatar_name" id="avatar_name" />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
            <label for="password">Confirm password</label>
            <input type="password" name="password" id="password" />
            <button type="submit">Create account</button>
        </form>
    </main>

</body>

</html>