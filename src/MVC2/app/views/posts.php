<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    <h1>Lista de Artículos</h1>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <strong><?php echo htmlspecialchars($post['title']); ?></strong><br>
                <?php echo htmlspecialchars($post['content']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
