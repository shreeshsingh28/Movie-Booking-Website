<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_website";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the selected theater from the AJAX request
$selectedTheater = $_POST['theatre'] ?? '';

// Fetch screens based on the selected theater
$sql = "SELECT screen_no FROM screen WHERE tname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedTheater);
$stmt->execute();
$result = $stmt->get_result();

$screens = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $screens[] = $row["screen_no"];
    }
}

$stmt->close();
$conn->close();

// Return screen numbers as JSON
echo json_encode($screens);
?>
