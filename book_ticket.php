<?php
// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "movie_website";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$u_email = $_POST['u_email'];
$tname = $_POST['theatre'];
$screen_no = $_POST['screen'];
$movie_name = $_POST['movie'];
$timming = $_POST['timing'];
$seats_required = $_POST['seatsRequired'];
$amt_paid = $_POST['amountToPay'];

// Generate ticket ID
$sql_max_tid = "SELECT MAX(SUBSTRING(tid, 2)) AS max_tid FROM ticket";
$result_max_tid = $conn->query($sql_max_tid);
$row_max_tid = $result_max_tid->fetch_assoc();
$max_tid = $row_max_tid['max_tid'];
$new_tid_numeric = intval($max_tid) + 1;
$new_tid = "T" . str_pad($new_tid_numeric, 3, "0", STR_PAD_LEFT);

// Insert data into the ticket table
$sql_insert_ticket = "INSERT INTO ticket (tid, u_email, tname, screen_no, movie_name, timming, seats, amt_paid)
                      VALUES ('$new_tid', '$u_email', '$tname', '$screen_no', '$movie_name', '$timming', '$seats_required', '$amt_paid')";

if ($conn->query($sql_insert_ticket) === TRUE) {
    echo "Ticket booked successfully!";
} else {
    echo "Error: " . $sql_insert_ticket . "<br>" . $conn->error;
}

$conn->close();
?>
