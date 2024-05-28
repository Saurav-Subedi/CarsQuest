<?php
$servername = "localhost"; // Update with your server details
$username = "root"; // Update with your database username
$password = "123123"; // Update with your database password
$dbname = "car_quest"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM sellers WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Start session and store user information
            session_start();
            $_SESSION['username'] = $username;
            // Redirect to seller page
            header("Location: ../html/seller.html");
            exit();
        } else {
            echo "<script>document.getElementById('error-message').style.display = 'block';</script>";
        }
    } else {
        echo "<script>document.getElementById('error-message').style.display = 'block';</script>";
    }
}

$conn->close();
?>
