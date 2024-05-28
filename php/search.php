<?php
$servername = "localhost"; // Update with your server details
$username = "root"; // Update with your database username
$password = "123123"; // Update with your database password
$dbname = "car_quest"; // Update with your database name
// Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $model = $_GET['model'];
    $location = $_GET['location'];

    // Query to search for cars based on model and location
    $sql = "SELECT * FROM cars WHERE model LIKE '%$model%' AND location LIKE '%$location%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='car'>";
            echo "<p><strong>Make:</strong> " . $row["make"] . "</p>";
            echo "<p><strong>Model:</strong> " . $row["model"] . "</p>";
            echo "<p><strong>Year:</strong> " . $row["year"] . "</p>";
            echo "<p><strong>Price:</strong> $" . $row["price"] . "</p>";
            echo "<p><strong>Location:</strong> " . $row["location"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No cars found matching the search criteria.";
    }
}

$conn->close();
?>
