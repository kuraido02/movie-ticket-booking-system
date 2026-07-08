<?php

    $conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "ticket_system"
    );

    if(!$conn){
        die("Connection failed" . mysqli_connect_error());
    }

?>