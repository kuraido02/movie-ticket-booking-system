<?php

require "db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$movie_id = $_POST['movie'];

$movie_result = mysqli_query(
        $conn,
        "SELECT * FROM movies WHERE id = '$movie_id'"
);

$movie = mysqli_fetch_assoc($movie_result);

$ticket_price = $movie['price'];
$total = $ticket_price;

$movie_title = $movie['title'];

$sql = "UPDATE orders
        SET
        name = '$name',
        email = '$email',
        contact = '$contact',
        movie = '$movie_title',
        total = $total
        WHERE id = '$id'
        ";

mysqli_query($conn, $sql);

header("Location: admin.php");
exit();

?>