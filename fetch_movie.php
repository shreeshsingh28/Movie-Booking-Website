<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_website";

// Retrieve the selected theater from the AJAX request
$selectedTheater = $_POST['theatre'] ?? '';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch movies based on the selected theater from the movie_show table
$sql = "SELECT DISTINCT movie_name FROM movie_show WHERE tname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedTheater);
$stmt->execute();
$result = $stmt->get_result();

$movies = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row["movie_name"];
    }
}

$stmt->close();
$conn->close();

// Return movie names as JSON
echo json_encode($movies);
?>
