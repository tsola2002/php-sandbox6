<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exiting a Script</title>
</head>
<body>
    <h1>Exiting a Script in PHP</h1>

    <?php 

        if(!file_exists("peter.php")) {
            die("File does not exist");
            echo "This line will not be executed";  
        } else{
            echo "File exists";
        }
    
    ?>
</body>
</html>