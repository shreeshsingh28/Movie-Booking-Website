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

// Retrieve form data
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$dob = $_POST['dob'] ?? '';
$mob = $_POST['mob'] ?? '';

// Update customer information in the database
$sql = "UPDATE customer SET fname='$fname', lname='$lname', dob='$dob', mob='$mob' WHERE u_email='$username'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Profile updated successfully.');</script>";
} else {
    echo "<script>alert('Error updating profile.');</script>";
}

$conn->close();
?>
