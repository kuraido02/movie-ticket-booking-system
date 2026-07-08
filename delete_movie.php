<?php

session_start();

require 'db.php';

$id = $_POST['id'];

mysqli_query($conn, 
"DELETE FROM movies WHERE id = $id");

header("Location: movies.php");
exit();

?>