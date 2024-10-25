<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    if (!empty($username)) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Mesedez, sartu zure izena.";
    }
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Sartu zure izena</h1>
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Zure izena" required>
        <button type="submit">Sartu</button>
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>