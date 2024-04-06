<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Add Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
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
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Current Movies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Add Movie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Remove Movie</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>

<div class="form-container">
<h1 align = "center">Add Movie</h1>
<form>

<div class="mb-3">
<label for="location" class="form-label">Select Movie Theatre Location</label>
<select class="form-select" id="location" required>
  <option selected>Select a location</option>
  <option value="location1">Theatre Location 1</option>
  <option value="location2">Theatre Location 2</option>
  <!-- Add more locations as needed -->
</select>
</div>

<div class="mb-3">
<label for="exampleInputMovieName1" class="form-label">Enter Movie Name</label>
<input type="MovieName" class="form-control" id="exampleInputMovieName1">
</div>

<div class="mb-3">
<label for="time" class="form-label">Select Showtime</label>
<select class="form-select" id="time" required>
  <option selected>Select a showtime</option>
  <option value="time1">12:00 PM</option>
  <option value="time2">3:00 PM</option>
  <option value="time3">6:00 PM</option>
  <!-- Add more showtimes as needed -->
</select>
</div>

<div align="center" class="center-buttons">
<button type="submit" class="btn btn-primary">Confirm</button>
</div>
</form>
</div>

</body>
</html>




