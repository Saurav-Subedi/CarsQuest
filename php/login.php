<?php
$servername = "localhost";
$username = "root";
$password = "123123";
$dbname = "car_quest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, password FROM sellers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session
            $_SESSION['seller_id'] = $id;
            header("Location: ../html/seller.html");
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Incorrect password.'); window.location.href = '../html/seller.html';</script>";
        }
    } else {
        // Username not found
        echo "<script>alert('Username not found.'); window.location.href = '../html/seller.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
