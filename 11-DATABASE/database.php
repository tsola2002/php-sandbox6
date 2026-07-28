<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mysql and php</title>
</head>
<body>
    <h1>Integrating PHP with Mysql</h1>

    <?php
        // Create connection Credentials
        $hostname = "localhost";
        $username = "phpuser";
        $password = "phppassword";
        $database = "phpapp";

        // 1. create a connection to our database
        $connection = mysqli_connect($hostname, $username, $password, $database);

        // 2. check if the connection is successful
        // if (!$connection) {
        //     die("Connection failed: " . mysqli_connect_error());
        // } else{
        //     echo "<h2>Connection successful!</h2>";
        // }

        function createRecord($id, $name, $qualification, $experience){
            global $connection;
            $insertQuery = "INSERT INTO TBL_USER (userid, name, qualification, experience) VALUES ('$id', '$name', '$qualification', '$experience')";

            // executing the query
        return $connection->query($insertQuery);
        }

    function updateRecord($id, $name, $qualification, $experience) {
        global $connection;
        $updateQuery = "UPDATE TBL_USER 
                        SET 
                        name = '$name', 
                        qualification = '$qualification', experience = '$experience' 
                        WHERE userid ='$id'";
        // executing the query
        return $connection->query($updateQuery);
    }

    function deleteRecord($id) {
        global $connection;
        $deleteQuery = "DELETE FROM TBL_USER WHERE userid = '$id'";
        // executing the query
        return $connection->query($deleteQuery);
    }

        // FUNCTION USAGE
        // creatig a record in the database
        // createRecord(6, "Ephraim", "BSc", 20);

        // updating a record in the database
        // updateRecord(6, "Precious", "PHD", 50);

        // deleting a record in the database
        deleteRecord(6);

        // 3. create a query to fetch data from the database
        $query = "SELECT * FROM TBL_USER";
        $result = $connection->query($query);

    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Qualification</th>
            <th>Experience</th>
          </tr>";

          while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo "<tr><td>" . $row['userid'] . "</td><td>"
              . $row['name'] . "</td><td>" 
              . $row['qualification'] . "</td><td>" 
              . $row['experience'] . "</td></tr>";
          }
    echo "</table>";



    ?>
</body>
</html>