<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

require 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST['title'];
    $price = $_POST['price'];

    $sql = "INSERT INTO movies(title, price)
            VALUES('$title', '$price')";

    mysqli_query($conn, $sql);
}

$result = mysqli_query($conn, "SELECT * FROM movies");
?>

<link rel="stylesheet" href="style.css">

<div class="admin-container">

    <div class="admin-header">

        <h1>Movie Management</h1>

        <a href="admin.php" class="movie-btn">
            Back to Admin
        </a>

    </div>

    <form method="post" class="movie-form">

        <input
            type="text"
            name="title"
            placeholder="Movie Title"
            required>

        <input
            type="number"
            name="price"
            placeholder="Ticket Price"
            required>

        <input
            type="submit"
            value="Add Movie">

    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Movie</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php
            while($row = mysqli_fetch_assoc($result)){
        ?>

        <tr>
            
            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['title']; ?></td>

            <td>₱<?php echo $row['price']; ?></td>

            <td>
                <a class="update-btn"
                href="edit_movie.php?id=<?php echo $row['id']; ?>">
                    Edit
                </a>
            </td>

            <td>

                <form action="delete_movie.php"
                    method="post"
                    onsubmit="return confirm('Delete this Movie?');">

                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo $row['id']; ?>">

                    <input
                        type="submit"
                        value="Delete">

                </form>

            </td>

        </tr>

        <?php
        }
        ?>
    </table>

</div>