<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>custom error handler</title>
</head>
<body>
    <h1>Working with custom error handler in PHP</h1>
    <?php  
        function customErrorHandler($errNo, $errStr,        $errFile, $errLine) {
            echo "<strong>Error:</strong> [$errNo] $errStr - $errFile:$errLine";
            echo "<br>";
            echo "Ending Script";
        }

        set_error_handler("customErrorHandler");

        echo $someFile;
    
    ?>
</body>
</html>