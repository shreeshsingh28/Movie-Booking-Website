<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Custom CSS -->
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
        <h1 align="center">Admin Login</h1>
        <!-- Admin login form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="admin_email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="admin_password" required>
            </div>
            <div align="center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <?php
        // Start the session
        session_start();

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "movie_website";
  
          $conn = new mysqli($servername, $username, $password, $dbname);
  
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

            // Get form data
            $admin_email = $_POST['admin_email'];
            $admin_password = $_POST['admin_password'];

            // SQL query to check if admin exists
            $sql = "SELECT * FROM admin WHERE a_email = '$admin_email' AND a_password = '$admin_password'";

            // Execute query
            $result = $conn->query($sql);

            // Check if admin exists and credentials are correct
            if ($result->num_rows > 0) {
                // Admin found, redirect to admin home page
                $_SESSION['admin_email'] = $admin_email; // Store admin email in session for later use
                header("Location: admin_home.php");
                exit();
            } else {
                // Admin not found or credentials are incorrect, show error message
                echo '<div class="alert alert-danger" role="alert">Invalid email or password</div>';
            }

            // Close database connection
            $conn->close();
        }
        ?>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
