<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_website";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username from the URL query parameter
$username = $_GET['u_email'] ?? '';

// Fetch customer information from the database
$sql = "SELECT fname, lname, dob, mob FROM customer WHERE u_email = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output customer information
    $row = $result->fetch_assoc();
    $fname = $row["fname"];
    $lname = $row["lname"];
    $dob = $row["dob"];
    $mob = $row["mob"];
} else {
    echo "No customer found with the provided email.";
    // You can handle this case as per your requirement
}

$conn->close();
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

<div class="form-container">
    <h2>Profile Information</h2>
    <form action="update_profile.php?u_email=<?php echo urlencode($username); ?>" method="post">
        <div class="mb-3">
            <label for="fname" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth:</label>
            <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" value="<?php echo $username; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="mob" class="form-label">Mobile:</label>
            <input type="text" class="form-control" id="mob" name="mob" value="<?php echo $mob; ?>" readonly>
        </div>
    </form>
</div>

</body>
</html>
