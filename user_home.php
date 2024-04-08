<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
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

        .navbar {
            margin-bottom: 20px; /* Add margin-bottom to create space below navbar */
        }

        .movie-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 70px;
            gap: 20px;
            padding: 20px;
        }

        .movie-card {
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
        }

        .movie-card img {
            width: 100%;
            height: auto;
        }

        .movie-card-body {
            padding: 10px;
        }

        .movie-card-title {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .movie-card-details {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>
<?php
// Retrieve username from the URL query parameter
$username = $_GET['u_email'] ?? '';
?>

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
                        <a class="nav-link active" aria-current="page" href="user_home.php?u_email=<?php echo urlencode($username); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_profile.php?u_email=<?php echo urlencode($username); ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_book.php?u_email=<?php echo urlencode($username); ?>">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_history.php?u_email=<?php echo urlencode($username); ?>">Booking History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_login.php">Log Out</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Welcome, <?php echo $username; ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>


<div class="movie-container">
    <?php
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

    // Fetch movies from the database
    $sql = "SELECT movie_name, language, genre, rating, image_dir FROM movie";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='movie-card'>";
            echo "<img src='Images/" . $row["image_dir"] . "' alt='" . $row["movie_name"] . "'>";
            echo "<div class='movie-card-body'>";
            echo "<h3 class='movie-card-title'>" . $row["movie_name"] . "</h3>";
            echo "<class='movie-card-details'>Language: " . $row["language"] . "<br>";
            echo "<class='movie-card-details'>Genre: " . $row["genre"] . "<br>";
            echo "<class='movie-card-details'>Rating: " . $row["rating"] . "<br>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No movies found";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
