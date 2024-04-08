<?php
ob_start(); // Start output buffering
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book</title>
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
            margin-top: 70px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 500px;
            text-align: left;
        }
    </style>
    <script src="script.js"></script>
</head>

<body>
<?php
// Retrieve username from the URL query parameter
$email = $_GET['u_email'] ?? '';
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
                        <a class="nav-link active" aria-current="page" href="user_home.php?u_email=<?php echo urlencode($email); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_profile.php?u_email=<?php echo urlencode($email); ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_book.php?u_email=<?php echo urlencode($email); ?>">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_history.php?u_email=<?php echo urlencode($email); ?>">Booking History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_login.php">Log Out</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Welcome, <?php echo $email; ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="form-container">
    <h2>Book Movie</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="mb-3">
        <label for="theatre" class="form-label">Select Theatre:</label>
        <select class="form-select" id="theatre" name="theatre" onchange="fetchData()" >
            <option value="">Select Theatre</option>
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

            // Fetch theaters from the database
            $sql = "SELECT tname FROM theatre";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["tname"] . "'>" . $row["tname"] . "</option>";
                }
            } else {
                echo "<option value=''>No theaters available</option>";
            }
            $conn->close();
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="screen" class="form-label">Select Screen:</label>
        <select class="form-select" id="screen" name="screen" >
            <option value="">Select Screen</option>
        </select>
    </div>

<div class="mb-3">
            <label for="movie" class="form-label">Select Movie:</label>
            <select class="form-select" id="movie" name="movie" onchange="fetchTimings()">
                <option value="">Select Movie</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="timing" class="form-label">Select Timing:</label>
            <select class="form-select" id="timing" name="timing" onchange="fetchAvailableSeats()">
                <option value="">Select Timing</option>
                </select>
        </div>
        <div class="mb-3">
            <label for="seatsAvailable" class="form-label">Seats Available:</label>
            <input type="text" class="form-control" id="seatsAvailable" name="seatsAvailable" readonly>
        </div>
        <div class="mb-3">
            <label for="seatsRequired" class="form-label">Seats Required:</label>
            <input type="number" class="form-control" id="seatsRequired" name="seatsRequired" min="1" onchange="checkSeatsAndCalculate()">
        </div>
        <div class="mb-3">
            <label for="amountToPay" class="form-label">Amount to Pay: (Rs. 100 per ticket)</label>
            <input type="text" class="form-control" id="amountToPay" name="amountToPay" readonly>
        </div>
        <input type="hidden" id="email" name="email" value="<?php echo $email; ?>">
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>

<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "movie_website";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data from POST request
    $email1 = $_POST['email'];
    $theatre = $_POST['theatre'];
    $screen = $_POST['screen'];
    $movie = $_POST['movie'];
    $timing = $_POST['timing'];
    $seatsRequired = $_POST['seatsRequired'];
    $amountToPay = $_POST['amountToPay'];

    // Generate ticket ID
    $sql_max_tid = "SELECT MAX(SUBSTRING(tid, 2)) AS max_tid FROM ticket";
    $result_max_tid = $conn->query($sql_max_tid);
    $row_max_tid = $result_max_tid->fetch_assoc();
    $max_tid = $row_max_tid['max_tid'];
    $new_tid_numeric = intval($max_tid) + 1;
    $new_tid = "T" . str_pad($new_tid_numeric, 3, "0", STR_PAD_LEFT);

    // Example of inserting data into a database
    $sql_insert_ticket = "INSERT INTO ticket (tid, u_email, tname, screen_no, movie_name, timming, seats, amt_paid) VALUES ('$new_tid', '$email1', '$theatre', '$screen', '$movie', '$timing', '$seatsRequired', '$amountToPay')";

    if (mysqli_query($conn, $sql_insert_ticket)) {
        // Update movie_show table with remaining available seats
        $sql_update_show = "UPDATE movie_show SET seats_left = seats_left - $seatsRequired WHERE movie_name = '$movie' AND tname = '$theatre' AND timming = '$timing'";
        
        if (mysqli_query($conn, $sql_update_show)) {
            $_SESSION['username'] = $email1;
                // Redirect to user home page with u_email parameter
                header("Location: user_history.php?u_email=" . $email1);
                exit();
        } else {
            echo "Error updating seats_left: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting ticket: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>



</body>
</html>
<?php
ob_end_flush(); // Flush the output buffer and send the content to the browser
?>