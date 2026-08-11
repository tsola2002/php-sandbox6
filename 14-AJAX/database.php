<?php 
    // DATABASE CONNECTION 

    $hostname = "localhost";
    $username = "root"; 
    $password = "";
    $database = "school_db";
    $port = 3306;

    $conn = mysqli_connect($hostname, $username, $password, $database, $port);

    if(!$conn){
        die("Could not connect to the database: " . mysqli_connect_error());
    } else{
        echo "Connected to the database successfully!";
    }


?>