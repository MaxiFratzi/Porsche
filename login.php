<?php
// Start the session: must be the first command
session_start();
?>

<?php
    if (!isset($_REQUEST['email']) || !isset($_REQUEST['password'])) {
        // $_SESSION: enthält die Session-Variablen:
        // Diese existieren  für die Dauer der Session: 
        // Bis die Session beendet wird oder der Browser geschlossen wird. 
        $_SESSION['err']="Login: Email or password is empty";
        header("Location: error.php");
        exit();
    }
    $email = $_REQUEST['email'];
    $pass = $_REQUEST['password'];
    if (empty($email) || empty($pass)) {
        $_SESSION['err']="Login: Email or password is empty";
        header("Location: error.php");
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "newsporsche";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $_SESSION['err']=$conn->connect_error;
        header("Location: error.php");
        exit(); 
    }

    $sql="SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    if ($stmt->error) {
        $_SESSION['err']= $stmt->error;
        header("Location: error.php");
        $conn->close();
        exit(); 
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Save the username in the session
        $_SESSION['email']=$email;
        header("Location: Porsche.html");
    } else {
        $_SESSION['err']="Login failed";
        header("Location: formular.php");
    }

    $stmt->close();
    $conn->close();

?>
    