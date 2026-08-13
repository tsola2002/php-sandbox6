<?php 

require "database.php";

// GRAB INFO FROM POST SUPER GLOBAL

$id  = $_POST['id'] ?? "";
$name = mysqli_real_escape_string($connection, $_POST['name']);
$email = mysqli_real_escape_string($connection, $_POST['email']);


// SAVE FOR DETAILS INTO THE DATABASE
if($id){
    // UPDATE
    $query = "UPDATE tbl_student
              SET name='$name',
                  email ='$email'
              WHERE id=$id";
} else{
    // INSERT
    $query = "INSERT INTO tbl_student(name, email)
              VALUES ('$name', '$email')"; 
}

mysqli_query($connection, $query);