<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_website";

// Retrieve the selected theater and movie from the AJAX request
$selectedTheater = $_POST['theatre'] ?? '';
$selectedMovie = $_POST['movie'] ?? '';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch timings based on the selected theater and movie from the movie_show table
$sql = "SELECT timming FROM movie_show WHERE tname = ? AND movie_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $selectedTheater, $selectedMovie);
$stmt->execute();
$result = $stmt->get_result();

$timings = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $timings[] = $row["timming"];
    }
}

$stmt->close();
$conn->close();

// Return timings as JSON
echo json_encode($timings);
?>
