<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History</title>
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

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff; /* White background color */
            padding: 20px; /* Add padding for spacing */
            border-radius: 8px; /* Add border radius for rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
            text-align: center;
        }

        th, td {
            padding: 8px;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .fixed-top {
            position: fixed;
            top: 0;
            width: 100%;
        }

        .navbar {
            background-color: #343a40; /* Dark background color */
        }

        .navbar-brand {
            font-size: 24px;
        }

        .navbar-toggler {
            border-color: #fff; /* White border color */
        }

        .navbar-nav .nav-link {
            color: #fff !important; /* White text color */
        }

        .welcome-message {
            color: white;
            text-align: center;
            font-size: 36px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px; /* Adjust spacing from top */
        }

        .welcome-message h1 {
            margin-bottom: 20px; /* Adjust spacing below heading */
        }

        .welcome-message p {
            font-size: 20px; /* Adjust paragraph font size */
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
<?php
// Retrieve username from the URL query parameter
$email = $_GET['u_email'] ?? '';

// Database connection
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "movie_website";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch booking history for the user
$sql = "SELECT * FROM ticket WHERE u_email = '$email'";
$result = $conn->query($sql);
?>

<div class="fixed-top">
    <!-- Navbar code -->
</div>

<div class="container">
    <h2>Booking History</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Theatre</th>
                <th>Screen No</th>
                <th>Movie Name</th>
                <th>Timing</th>
                <th>Seats</th>
                <th>Amount Paid</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["tid"] . "</td>";
                    echo "<td>" . $row["tname"] . "</td>";
                    echo "<td>" . $row["screen_no"] . "</td>";
                    echo "<td>" . $row["movie_name"] . "</td>";
                    echo "<td>" . $row["timming"] . "</td>";
                    echo "<td>" . $row["seats"] . "</td>";
                    echo "<td>" . $row["amt_paid"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No booking history found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Close database connection
$conn->close();
?>

</body>
</html>
