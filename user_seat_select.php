<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seat Selection</title>
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
      flex-direction: column;
    }

    .seat-container {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 10px;
      max-width: 400px;
      margin: auto;
    }

    .seat {
      width: 40px;
      height: 40px;
      background-color: #bdc3c7;
      border: 1px solid #34495e;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
    }

    .seat.selected {
      background-color: #3498db;
    }

    .seat.occupied {
      background-color: #ecf0f1;
      cursor: not-allowed;
    }

    .seat:not(.occupied):hover {
      background-color: #95a5a6;
    }

    .booking-info {
      margin-top: 10px; /* Adjusted margin */
      text-align: center;
      padding: 10px; /* Added padding */
    }

    .booking-info p {
      margin: 5px;
    }

    .btn-book {
      margin-top: 10px; /* Adjusted margin */
      background-color: #3498db;
      color: #fff;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="seat-container" id="seat-container"></div>
<div class="booking-info">
  <p>Selected Seats: <span id="selected-seats">None</span></p>
  <p>Total Price: ₹<span id="total-price">0</span></p>
  <button class="btn-book" onclick="bookSeats()">Book Now</button>
</div>

<script>
  const seatContainer = document.getElementById('seat-container');
  const selectedSeatsElement = document.getElementById('selected-seats');
  const totalPriceElement = document.getElementById('total-price');
  let selectedSeats = [];
  let totalPrice = 0;

  // Create seats
  const rows = ['A', 'B', 'C', 'D', 'E'];
  for (let i = 0; i < rows.length; i++) {
    for (let j = 1; j <= 5; j++) {
      const seat = document.createElement('div');
      seat.className = 'seat';
      seat.dataset.seatNumber = `${rows[i]}${j}`;
      seat.textContent = `${rows[i]}${j}`;
      seat.addEventListener('click', toggleSeat);
      seatContainer.appendChild(seat);
    }
  }

  function toggleSeat() {
    const seat = this;

    if (seat.classList.contains('occupied')) {
      return;
    }

    seat.classList.toggle('selected');

    const seatNumber = seat.dataset.seatNumber;

    if (selectedSeats.includes(seatNumber)) {
      selectedSeats = selectedSeats.filter(number => number !== seatNumber);
      totalPrice -= 100; // Adjust the price as needed
    } else {
      selectedSeats.push(seatNumber);
      totalPrice += 100; // Adjust the price as needed
    }

    updateBookingInfo();
  }

  function updateBookingInfo() {
    selectedSeatsElement.textContent = selectedSeats.length === 0 ? 'None' : selectedSeats.join(', ');
    totalPriceElement.textContent = totalPrice;
  }

  function bookSeats() {
    if (selectedSeats.length === 0) {
      alert('Please select at least one seat.');
    } else {
      alert(`Booked seats: ${selectedSeats.join(', ')}\nTotal Price: ₹${totalPrice}`);
      // You can add logic to send the booking information to the server here
    }
  }
</script>

</body>
</html>
