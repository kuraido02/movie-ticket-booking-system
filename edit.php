<?php

    require "db.php";

    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM orders WHERE id = $id"); 

    $row = mysqli_fetch_assoc($result);

    $movies = mysqli_query($conn, "SELECT * FROM movies");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <form action="update.php" method="post">
            <input 
                type="text" 
                name="name" 
                value="<?php echo $row['name']; ?>"> 
            
            <br><br>
        
            <input 
                type="email" 
                name="email" 
                value="<?php echo $row['email']; ?>">

            <br><br>
        
            <input 
                type="tel" 
                name="contact" 
                maxlength="11" 
                value="<?php echo $row['contact']; ?>">

            <br><br>
        
            <select name="movie">
                <?php
                    while($movie = mysqli_fetch_assoc($movies)){
                ?>

                    <option
                        value="<?php echo $movie['id']; ?>"
                        <?php
                            if($movie['title'] == $row['movie']){
                                echo "selected";
                            }
                        ?>
                    >

                        <?php echo $movie['title']; ?>
                    </option>

                <?php
                    }
                ?>
            </select>

            <br><br>
        
            <input 
                type="hidden" 
                name="id" value="<?php echo $row['id']; ?>">

            <input type="submit" value="Save Changes">         
        </form>

    </div>
</body>
</html>