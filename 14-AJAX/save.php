<?php

require "database.php";

$id = $_POST['id'] ?? "";
$name = $_POST['name'] ?? "";
$email = $_POST['email'] ?? "";

$name = mysqli_real_escape_string($connection, $name);
$email = mysqli_real_escape_string($connection, $email);

if (empty($name) || empty($email)) {
    die("Name and email are required.");
}

if (empty($id)) {

    // INSERT
    $query = "INSERT INTO tbl_student (name, email)
              VALUES ('$name', '$email')";

} else {

    // UPDATE
    $id = mysqli_real_escape_string($connection, $id);

    $query = "UPDATE tbl_student
              SET name = '$name',
                  email = '$email'
              WHERE id = '$id'";
}

if (mysqli_query($connection, $query)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($connection);
}