<?php
// Start the session: must be the first command
session_start();

// Check if email and password are set
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $_SESSION['err'] = "Registration: Email or password is empty";
    header("Location: register.php");
    exit();
}

$email = $_POST['email'];
$pass = $_POST['password'];

// Check if email and password are empty
if (empty($email) || empty($pass)) {
    $_SESSION['err'] = "Registration: Email or password is empty";
    header("Location: register.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "newsporsche";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $_SESSION['err'] = $conn->connect_error;
    header("Location: register.php");
    exit();
}

// Insert user data into the database
$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $pass);
$stmt->execute();

if ($stmt->error) {
    $_SESSION['err'] = $stmt->error;
    header("Location: register.php");
    $conn->close();
    exit();
}

// Registration successful
$_SESSION['email'] = $email;
header("Location: Porsche.html");

$stmt->close();
$conn->close();
?>