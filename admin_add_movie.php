<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('Images/homebg.jpg'); /* Add your background image path here */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 500px;
            text-align: left;
        }

    </style>
</head>

<body>
<div class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">S Movies</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin_home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_add_movie.php">Add Movie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_add_show.php">Add Show</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_running_shows.php">Running Shows</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_login.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- Add Movie form -->
<div class="form-container">
    <h2 align="center">Add Movie</h2>
    <form id="addMovieForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="movieName" class="form-label">Movie Name</label>
            <input type="text" class="form-control" id="movieName" name="movieName" required>
        </div>
        <div class="mb-3">
            <label for="language" class="form-label">Language</label>
            <input type="text" class="form-control" id="language" name="language" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" required>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (Out of 10)</label>
            <input type="number" class="form-control" id="rating" name="rating" min="1" max="10" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Select Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary" align="center">Add Movie</button>
    </form>
</div>

<script>
    document.getElementById("addMovieForm").addEventListener("submit", function(event) {
        var inputs = document.querySelectorAll("#addMovieForm input[type=text], #addMovieForm input[type=number]");
        var empty = false;

        inputs.forEach(function(input) {
            if (input.value.trim() === "") {
                empty = true;
            }
        });

        if (empty) {
            event.preventDefault();
            alert("Please fill in all fields.");
        }
    });
</script>

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
    $stmt->bind_param("sssis", $movie_name, $language, $genre, $rating, $image_file_name);

    // Set parameters
    $movie_name = $_POST['movieName'];
    $language = $_POST['language'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];

    // Get only the file name
    $image_file_name = basename($_FILES["image"]["name"]);

    // Execute the query
    if ($stmt->execute()) {
        // File uploaded successfully
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


</body>
</html>
