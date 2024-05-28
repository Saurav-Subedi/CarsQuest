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

$model = $_GET['model'];
$location = $_GET['location'];

// Fetch cars matching the model and location
$sql = "SELECT id, make, model, year, price FROM cars WHERE model LIKE ? AND location LIKE ?";
$stmt = $conn->prepare($sql);
$model = "%$model%";
$location = "%$location%";
$stmt->bind_param("ss", $model, $location);
$stmt->execute();
$stmt->bind_result($id, $make, $model, $year, $price);
$stmt->store_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../css/search_results.css">
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
    <div class="results-container">
        <h2 class="results-title">Search Results</h2>
        <ul class="results-list">
            <?php
            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    echo "<li>";
                    echo "<h3>$make $model ($year)</h3>";
                    echo "<p>Price: $$price</p>";
                    echo "<a href='car_details.php?id=$id' class='button'>View Details</a>";
                    echo "</li>";
                }
            } else {
                echo "<p>No cars found matching your criteria.</p>";
            }
            ?>
        </ul>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
