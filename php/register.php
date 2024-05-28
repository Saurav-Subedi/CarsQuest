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
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

    $sql = "INSERT INTO sellers (name, address, phone, email, username, password) VALUES ('$name', '$address', '$phone', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>document.getElementById('acknowledgment').style.display = 'block';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!-- CREATE TABLE sellers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
 -->