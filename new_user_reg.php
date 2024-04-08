<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_login.php">User Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_login.php">Admin Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="form-container">
    <h1 align="center">New User Registration</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputFirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="exampleInputFirstName" name="fname">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputLastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputLastName" name="lname">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputDOB" class="form-label">Date of Birth (DD-MMM-YYYY)</label>
            <input type="text" class="form-control" id="exampleInputDOB" placeholder="YYYY-MM-DD" name="dob">
        </div>
        <div class="mb-3">
            <label for="exampleInputPhoneNumber" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="exampleInputPhoneNumber" placeholder="(+91)XXXXXXXXXX" name="phone">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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

    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Escape user inputs for security
    $fname = mysqli_real_escape_string($conn, $fname);
    $lname = mysqli_real_escape_string($conn, $lname);
    $dob = mysqli_real_escape_string($conn, $dob);
    $phone = mysqli_real_escape_string($conn, $phone);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);


    // Insert user data into the database
    $sql = "INSERT INTO customer (u_email, password, fname, lname, dob, mob) VALUES ('$email', '$password', '$fname', '$lname', '$dob', '$phone')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>

<script>
    function validateForm() {
        var firstName = document.getElementById("exampleInputFirstName").value;
        var lastName = document.getElementById("exampleInputLastName").value;
        var dob = document.getElementById("exampleInputDOB").value;
        var phone = document.getElementById("exampleInputPhoneNumber").value;
        var email = document.getElementById("exampleInputEmail1").value;
        var password = document.getElementById("exampleInputPassword1").value;

        // Check for empty fields
        if (firstName.trim() === "" || lastName.trim() === "" || dob.trim() === "" || phone.trim() === "" || email.trim() === "" || password.trim() === "") {
            alert("Please fill in all fields");
            return false;
        }

        // Email validation
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid email address");
            return false;
        }

        // Date of birth format validation
        var dobPattern = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/;
        if (!dobPattern.test(dob)) {
            alert("Please enter the date of birth in DD-MMM-YYYY format");
            return false;
        }

        // Phone number validation
        var phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phone)) {
            alert("Please enter a valid 10-digit phone number");
            return false;
        }

        return true; // Form submission allowed if all validations passed
    }
</script>

</body>
</html>
