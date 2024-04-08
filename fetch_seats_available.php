<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_website";

// Retrieve the selected theater, movie, and timing from the AJAX request
$selectedTheater = $_POST['theatre'] ?? '';
$selectedMovie = $_POST['movie'] ?? '';
$selectedTiming = $_POST['timing'] ?? '';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch available seats based on the selected theater, movie, and timing from the movie_show table
$sql = "SELECT seats_left FROM movie_show WHERE tname = ? AND movie_name = ? AND timming = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $selectedTheater, $selectedMovie, $selectedTiming);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $seatsAvailable = $row["seats_left"];
} else {
    $seatsAvailable = "N/A";
}

$stmt->close();
$conn->close();

// Return available seats
echo $seatsAvailable;
?>
