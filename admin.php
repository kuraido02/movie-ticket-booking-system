<?php

    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: login.php");
        exit();
    }

    require 'db.php';

    $search = $_GET['search'] ?? "";

    echo "<link rel='stylesheet' href='style.css'>";

    echo "<div class='admin-container'>";

    echo "
    <div class='admin-header'>

        <h1>Admin Panel</h1>

        <div class='admin-buttons'>

            <a href='movies.php' class='movie-btn'>
                Movie Management
            </a>

            <a href='logout.php' class='logout-btn'>
                Logout
            </a>
        
        </div>

    </div>

    <form action='admin.php' method='get' class='search-form'>

        <input type='text'
                name='search'
                placeholder='Search customer...'
                value='$search'>

        <input type='submit' value='Search'>

    </form>
    ";

    if ($search == ""){
        $sql = "SELECT * FROM orders";
    }
    else {
        $sql = "SELECT * FROM orders
                WHERE name LIKE '%$search%'
                OR movie LIKE '%$search%'
                OR email LIKE '%$search%'";
    }

    $result = mysqli_query($conn, $sql);

    echo "<div class='table-container'>";
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Movie</th>
            <th>Cinema</th>
            <th>Showtime</th>
            <th>Seat</th>
            <th>Total</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>";

    while($row = mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['contact']."</td>";
        echo "<td>".$row['movie']."</td>";
        echo "<td>".$row['cinema']."</td>";
        echo "<td>".$row['show_time']."</td>";
        echo "<td>".$row['seat']."</td>";
        echo "<td>₱".$row['total']."</td>";
        echo "<td>";
        echo "<a class='update-btn' href='edit.php?id=".$row['id']."'>Update</a>";
        echo "</td>";  
        echo "<td>";
        echo "
        <form action='delete.php' method='POST' 
        onsubmit=\"return confirm('Delete this booking?');\">
            <input type='hidden' name='id' value='".$row['id']."'>
            <input type='submit' value='Delete'>
        </form>
        ";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "</div>";

    echo "</div>";

?>