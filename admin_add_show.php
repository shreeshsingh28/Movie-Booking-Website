<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Show</title>
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

<!-- Add Show form -->
<div class="form-container">
    <h2 align="center">Add Show</h2>
    <form id="addShowForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mb-3">
            <label for="showId" class="form-label">Show ID</label>
            <input type="text" class="form-control" id="showId" name="showId" required>
        </div>
        <div class="mb-3">
            <label for="movieName" class="form-label">Movie Name</label>
            <select class="form-select" id="movieName" name="movieName" required>
                <option value="" disabled selected>Select Movie</option>
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

                // Fetch movie names from the database
                $sql = "SELECT movie_name FROM movie";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["movie_name"] . "'>" . $row["movie_name"] . "</option>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="theaterName" class="form-label">Theater Name</label>
            <select class="form-select" id="theaterName" name="theaterName" required>
                <option value="" disabled selected>Select Theater</option>
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

                // Fetch theater names from the database
                $sql = "SELECT tname FROM theatre";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["tname"] . "'>" . $row["tname"] . "</option>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="showTime" class="form-label">Show Time</label>
            <input type="time" class="form-control" id="showTime" name="showTime" required>
        </div>
        <button type="submit" class="btn btn-primary" align="center">Add Show</button>
        <?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $stmt = $conn->prepare("INSERT INTO movie_show (show_id, movie_name, tname, timming, seats_left) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $show_id, $movie_name, $tname, $time, $seats_left);

    // Set parameters
    $show_id = $_POST['showId'];
    $movie_name = $_POST['movieName'];
    $tname = $_POST['theaterName'];
    $time = $_POST['showTime'];
    $seats_left = 80; // Assuming default seats left is 80

    // Execute the query
    $stmt->execute();

    echo "<script>alert('New show added successfully');</script>";

    $stmt->close();
    $conn->close();
}
?>


    </form>
</div>

<script>
    document.getElementById("addShowForm").addEventListener("submit", function(event) {
        var inputs = document.querySelectorAll("#addShowForm input[type=text], #addShowForm select");
        var empty = false;

        inputs.forEach(function(input) {
            if (input.value.trim() === "" || input.value === null) {
                empty = true;
            }
        });

        if (empty) {
            event.preventDefault();
            alert("Please fill in all fields.");
        }
    });
</script>





</body>
</html>
