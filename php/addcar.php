<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../html/seller.html");
    exit();
}

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
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    
    // Retrieve seller ID based on username from session
    $username = $_SESSION['username'];
    $sql = "SELECT id FROM sellers WHERE username = '$username'";
    $result = $conn->query($sql);
    $seller_id = $result->fetch_assoc()['id'];
    
    // Insert car details into the database
    $sql = "INSERT INTO cars (make, model, year, price, seller_id) VALUES ('$make', '$model', '$year', '$price', '$seller_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>document.getElementById('acknowledgment').style.display = 'block';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!-- CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    seller_id INT,
    FOREIGN KEY (seller_id) REFERENCES sellers(id)
);
 -->