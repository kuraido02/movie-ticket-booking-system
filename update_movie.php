<?php

require "db.php";

$id = $_POST['id'];
$movie = $_POST['movie'];
$price = $_POST['price'];

$sql = "UPDATE movies
        SET
        title = '$movie',
        price = '$price'
        WHERE id = '$id'
        ";

mysqli_query($conn, $sql);

header("Location: movies.php");
exit();

?>