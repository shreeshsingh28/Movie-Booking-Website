<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('Images/homebg.jpg');
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
        <h1 align="center">User Login</h1>
        <?php
        // Establish database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "movie_website";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Query to check user credentials
            $sql = "SELECT * FROM customer WHERE u_email='$email' AND password='$password'";
            $result = $conn->query($sql);

            // Check if query returned any rows
            if ($result->num_rows > 0) {
                // User credentials are valid, redirect to user home page
                session_start();
                $_SESSION['username'] = $email;
                // Redirect to user home page with u_email parameter
                header("Location: user_home.php?u_email=" . $email);
                exit();
            } else {
                // User credentials are invalid, show error message
                echo "<p style='color:red; text-align:center;'>Invalid email or password</p>";
            }
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div align="center">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
                <a href="new_user_reg.php" class="btn btn-primary">New User</a>
            </div>
        </form>
    </div>
</body>
</html>
