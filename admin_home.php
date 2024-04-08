<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home</title>
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

        .welcome-message {
            color: white;
            text-align: center;
            font-size: 36px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
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
            </div>
        </div>
    </nav>
</div>

<div class="welcome-message">
    <h1>Welcome Admin User !</h1>
    <p>Feel free to update the movie database.</p>
</div>

</body>
</html>
