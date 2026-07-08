<?php

    session_start();

    require "db.php";

    $error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM admins 
            WHERE username = '$username'";

        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        if(!$row){
            $error =  "Username not found.";
        }
        elseif(!password_verify($password, $row['password'])){
            $error = "Incorrect password.";
        }
        else{
            $_SESSION['admin'] = true;

            header("Location: admin.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>

        <?php
        if($error != ""){
            echo "<p class='error'>$error</p>";
        }
        ?>

        <form action="login.php" method="post">
            <input type="text" name="username"
                    placeholder="Username" required>

            <br><br> 

            <input type="password" name="password"
                    placeholder="Password" required>

            <br><br>

            <input type="submit" value="Login">
        </form>
    
    </div>
</body>
</html>