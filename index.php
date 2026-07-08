<?php

require "db.php";

$error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"] ?? "";
        $email = $_POST["email"] ?? "";
        $contact = $_POST["contact"] ?? "";
        $movie_id = $_POST["movie"] ?? "";
        $cinema_id = $_POST["cinema"] ?? "";
        $showtime_id = $_POST["showtime"] ?? "";
        $seat = $_POST["seat"] ?? "";

        if(empty($name)){
            die("Enter your name.");
        }
        if(empty($email)){
            die("Enter your email.");
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            die("Invalid email.");
        }
        if(strlen($contact) != 11){
            die("Contact number must be 11 digits.");
        }

        $movie_result = mysqli_query(
            $conn,
            "SELECT * FROM movies WHERE id = '$movie_id'");

        $movie = mysqli_fetch_assoc($movie_result);

        $ticket_price = $movie['price'];

        $movie_title = $movie['title'];

        $total = $ticket_price;

        $cinema_result = mysqli_query(
            $conn,
            "SELECT * FROM cinemas WHERE id = '$cinema_id'"
        );

        $cinema_data = mysqli_fetch_assoc($cinema_result);

        $cinema = $cinema_data['cinema_name'];

        $show_date = date("F j, Y");

        $show_result = mysqli_query(
            $conn,
            "SELECT * FROM showtimes WHERE id = '$showtime_id'"
        );

        $show = mysqli_fetch_assoc($show_result);

        $show_time = $show['show_time'];

        $check = mysqli_query(
            $conn,
            "SELECT * FROM orders
            WHERE movie_id = '$movie_id'
            AND cinema = '$cinema'
            AND show_time = '$show_time'
            AND seat = '$seat'"      
        );

        if(mysqli_num_rows($check) > 0){
            $error = "Seat already taken! Please choose another seat.";
        }
        else {
            $sql = "INSERT INTO orders(
                name,
                email, 
                contact, 
                movie, 
                movie_id, 
                total, 
                seat, 
                cinema, 
                show_date, 
                show_time)
                        
            VALUES(
                '$name', 
                '$email', 
                '$contact', 
                '$movie_title', 
                '$movie_id', 
                '$total', 
                '$seat', 
                '$cinema', 
                '$show_date', 
                '$show_time')";

            if(mysqli_query($conn, $sql)){

                $booking_id = mysqli_insert_id($conn);

                header("Location: ticket.php?id=$booking_id");
                exit();
            }
        }
    }
?>

<?php

require 'db.php';

$result = mysqli_query($conn, "SELECT * FROM movies");

$cinemas = mysqli_query($conn, "SELECT * FROM cinemas");

$showtimes = mysqli_query($conn, "SELECT * FROM showtimes");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ivan's Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

    <h1>Movie Ticket</h1>

    <p>Book your favorite movie!</p>

    <?php
    if($error != ""){
    ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php
    }
    ?>

    <form action="index.php" method="post">
        <label>Name:</label> <br>
        <input type="text" name="name" placeholder="Juan Dela Cruz"> <br>
        <label>Email:</label> <br>
        <input type="email" name="email" placeholder="Email"> <br>
        <label>Contact No.:</label> <br>
        <input type="tel" name="contact" placeholder="09123456789" maxlength="11"> <br>
        <label>Movie:</label> <br>
        <select name="movie"> 
        <?php
            while($movie = mysqli_fetch_assoc($result)){
        ?>

        <option value="<?php echo $movie['id']; ?>">
            <?php echo $movie['title']; ?>
        </option>

        <?php
            }
        ?>
        </select> <br>
        <label>Cinema:</label> <br>
        <select name="cinema">
        <?php
            while($cinema = mysqli_fetch_assoc($cinemas)){
        ?>

        <option value="<?php echo $cinema['id']; ?>">
            <?php echo $cinema['cinema_name']; ?>
        </option>

        <?php
        }
        ?>
        </select> <br>
        <label>Showtime:</label> <br>
        <select name="showtime">
        <?php
            while($show = mysqli_fetch_assoc($showtimes)){
        ?>

        <option value="<?php echo $show['id']; ?>">
            <?php echo $show['show_time']; ?>
        </option>

        <?php
        }
        ?>
        </select> <br>
        <label>Select Seat:</label> <br>
        <select name="seat">
        <?php
        $rows = ['A', 'B', 'C', 'D'];

        foreach($rows as $row){
            for($i = 1; $i <= 5; $i++){
                $seat = $row . $i;

                echo "<option value='$seat'>$seat</option>";
            }
        }
        ?>
        </select> <br><br>  
        <input type="submit" value="Book Ticket">
    </form>

    <br>

    </div>
</body>
</html>
