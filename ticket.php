<?php

require "db.php";

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM orders WHERE id = '$id'";

$result = mysqli_query($conn, $sql);

$order = mysqli_fetch_assoc($result);

if(!$order){
    die("Booking not found.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Movie Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="movie-ticket">
        <div class="ticket-header">
            <h1>MOVIE TICKET</h1>
            <p>CINEMA ADMISSION PASS</p>
        </div>

        <div class="ticket-body">
            <p><span>Booking ID:</span> #<?php echo $order['id']; ?></p>
            <p><span>Movie:</span> <?php echo $order['movie']; ?></p>
            <p><span>Cinema:</span> <?php echo $order['cinema']; ?></p>
            <p><span>Date:</span> <?php echo $order['show_date']; ?></p>
            <p><span>Time:</span> <?php echo $order['show_time']; ?></p>
            <p><span>Seat:</span> <?php echo $order['seat']; ?></p>
            <p><span>Customer:</span> <?php echo $order['name']; ?></p>
            <p><span>Price:</span> ₱<?php echo $order['total']; ?></p>
        </div>

        <div class="barcode">
            ||||| || |||||| || |||| |||||| |||
        </div>

        <a href="index.php" class="book-another-ticket">
            Book Another Ticket
        </a>

    </div>
</body>
</html>