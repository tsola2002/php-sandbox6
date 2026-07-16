<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Reporting</title>
</head>
<body>
    <h1>Error Reporting in PHP</h1>

    <?php 

        // set the error reporting level
        error_reporting(E_ALL);

        ini_set("error_log", "error.log");

        $peter;

        echo 1 / 0;

        trigger_error("This is a custom error", E_USER_ERROR);  
    
    ?>
</body>
</html>