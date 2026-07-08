<?php

require "db.php";

$id = $_POST["id"];

$sql = "DELETE FROM orders WHERE id = $id";

mysqli_query($conn, $sql);

header("Location: admin.php");
exit();

?>