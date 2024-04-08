function fetchData() {
    fetchScreens();
    fetchMovies();
}


function fetchScreens() {
    var selectedTheater = document.getElementById("theatre").value;
    var screenSelect = document.getElementById("screen");

    // Clear previous options
    screenSelect.innerHTML = "<option value=''>Loading...</option>";

    // Fetch screens via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_screen.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var screens = JSON.parse(xhr.responseText);
            screenSelect.innerHTML = "<option value=''>Select Screen</option>";
            screens.forEach(function (screen) {
                screenSelect.innerHTML += "<option value='" + screen + "'>" + screen + "</option>";
            });
        }
    };
    xhr.send("theatre=" + selectedTheater);
}

function fetchMovies() {
    var selectedTheater = document.getElementById("theatre").value;
    var movieSelect = document.getElementById("movie");

    // Clear previous options
    movieSelect.innerHTML = "<option value=''>Loading...</option>";

    // Fetch movies via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_movie.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var movies = JSON.parse(xhr.responseText);
            movieSelect.innerHTML = "<option value=''>Select Movie</option>";
            movies.forEach(function (movie) {
                movieSelect.innerHTML += "<option value='" + movie + "'>" + movie + "</option>";
            });
        }
    };
    xhr.send("theatre=" + selectedTheater);
}

function fetchTimings() {
    var selectedTheater = document.getElementById("theatre").value;
    var selectedMovie = document.getElementById("movie").value;
    var timingSelect = document.getElementById("timing");

    // Clear previous options
    timingSelect.innerHTML = "<option value=''>Loading...</option>";

    // Fetch timings via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_timings.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var timings = JSON.parse(xhr.responseText);
            timingSelect.innerHTML = "<option value=''>Select Timing</option>";
            timings.forEach(function (timing) {
                timingSelect.innerHTML += "<option value='" + timing + "'>" + timing + "</option>";
            });
        }
    };
    xhr.send("theatre=" + selectedTheater + "&movie=" + selectedMovie);
}
function fetchAvailableSeats() {
    var selectedTheater = document.getElementById("theatre").value;
    var selectedMovie = document.getElementById("movie").value;
    var selectedTiming = document.getElementById("timing").value;
    var seatsAvailableInput = document.getElementById("seatsAvailable");

    // Fetch available seats via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_seats_available.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            seatsAvailableInput.value = xhr.responseText;
        }
    };
    xhr.send("theatre=" + selectedTheater + "&movie=" + selectedMovie + "&timing=" + selectedTiming);
}
function checkSeatsAndCalculate() {
    var seatsAvailable = parseInt(document.getElementById("seatsAvailable").value);
    var seatsRequired = parseInt(document.getElementById("seatsRequired").value);

    if (isNaN(seatsAvailable) || isNaN(seatsRequired)) {
        alert("Please enter valid numbers for seats available and seats required.");
        return;
    }

    if (seatsAvailable < seatsRequired) {
        alert("Seats available are less than seats required. Please select a lower number of seats.");
        document.getElementById("seatsRequired").value = seatsAvailable;
    }

    calculateAmount();
}

function calculateAmount() {
    var seatsRequired = parseInt(document.getElementById("seatsRequired").value);

    if (isNaN(seatsRequired)) {
        alert("Please enter a valid number for seats required.");
        return;
    }

    var amountToPay = seatsRequired * 100;
    document.getElementById("amountToPay").value = "Rs. " + amountToPay.toFixed(2);
}
