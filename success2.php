<?php
// Start the session: must be the first command
session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['err']="Login required";
    header("Location: formular.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Angemeldet</title>
</head>
<body>
    <h1>Sie sind angemeldet</h1>
    <?php
        echo "<p>Herzlich Willkommen: " . $_SESSION['email']."</p>";
    ?>
    <p><a href="logout.php">Logout</a></p>
    <p><a href="Porsche.html">Zur Website</a></p>
</body>
</html>