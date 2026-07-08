<?php

    require "db.php";

    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM movies WHERE id = $id"); 

    $row = mysqli_fetch_assoc($result);

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

    <h1>Edit Movie</h1>

    <form action="update_movie.php" method="post">
        <input 
            type="text" 
            name="movie" 
            value="<?php echo $row['title']; ?>"
            required> <br><br>

        <input
            type="number"
            name="price"
            value="<?php echo $row['price'];?>"
            required> <br><br>

        <input 
            type="hidden" 
            name="id" 
            value="<?php echo $row['id']; ?>">

        <input 
            type="submit" 
            value="Save Changes"> <br><br>         
    </form>

    <a href="movies.php" class="movie-btn">
        Cancel
    </a>

    </div>

</body>
</html>