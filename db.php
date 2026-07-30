<?php

$conn = mysqli_connect(
    "sql308.infinityfree.com",
    "if0_42361013",
    "jiIx11RO91oVeo",
    "if0_42361013_movie_ticket"
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>