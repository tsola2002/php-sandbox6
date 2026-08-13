<?php 

require "database.php";

$id = $_POST['id'];

$query = "DELETE FROM tbl_student WHERE id=$id";

mysqli_query($connection, $query);