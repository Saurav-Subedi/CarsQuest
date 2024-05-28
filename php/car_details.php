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

$car_id = $_GET['id'];

// Fetch car details
$sql = "SELECT make, model, year, price, seller_id FROM cars WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $car_id);
$stmt->execute();
$stmt->bind_result($make, $model, $year, $price, $seller_id);
$stmt->fetch();
$stmt->close();  // Close the first statement

// Fetch seller details
$sql_seller = "SELECT name, email FROM sellers WHERE id = ?";
$stmt_seller = $conn->prepare($sql_seller);
$stmt_seller->bind_param("i", $seller_id);
$stmt_seller->execute();
$stmt_seller->bind_result($seller_name, $seller_email);
$stmt_seller->fetch();
$stmt_seller->close();  // Close the second statement

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link rel="stylesheet" href="../css/car_details.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="../html/index.html" class="logo"><img src="../images/logo.png" alt="CarQuest Logo"></a>
            <ul class="nav-links">
                <li><a href="../html/about_us.html">About Us</a></li>
                <li><a href="../html/seller_registration.html">Register</a></li>
                <li><a href="../html/seller_login.html">Login</a></li>
                <li><a href="../html/addcar.html">Add Car</a></li>
            </ul>
        </div>
    </nav>
    <div class="details-container">
        <h2 class="details-title"><?php echo htmlspecialchars("$make $model ($year)"); ?></h2>
        <p><strong>Price:</strong> $<?php echo htmlspecialchars($price); ?></p>
        <h3>Seller Information</h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($seller_name); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($seller_email); ?></p>
    </div>
</body>
</html>
