<?php
// Check if form is submitted and file is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "movie_website";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO movie (movie_name, language, genre, rating, image_dir) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $movie_name, $language, $genre, $rating, $image_dir);

    // Set parameters and execute
    $movie_name = $_POST['movieName'];
    $language = $_POST['language'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];

    // Upload image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image_dir = realpath($target_file); // Get the full location of the image
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $stmt->execute();

    echo "New record created successfully";

    $stmt->close();
    $conn->close();
}
?>