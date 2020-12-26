<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="newpost.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <h1>Create new post</h1>
        <form action="index.php" method="post">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" />
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Write something.." style="height:200px"></textarea>
            <label for="Link">Link</label>
            <input type="url" name="link" id="link">
            <button type="submit">Create</button>
        </form>
    </main>

</body>

</html>