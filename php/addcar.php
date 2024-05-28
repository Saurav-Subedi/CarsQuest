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

if (!isset($_SESSION['seller_id'])) {
    header("Location: ../html/seller_login.html");
    exit();
}

$seller_id = $_SESSION['seller_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $location = $_POST['location'];

    $sql = "INSERT INTO cars (make, model, year, price, location, seller_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissi", $make, $model, $year, $price, $location, $seller_id);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Car added successfully.'); window.location.href = '../html/seller.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
