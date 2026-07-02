<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading Sessions</title>
</head>
<body>
    <h1>Reading Sessions in PHP</h1>
    <?php
        echo "Hello " . $_SESSION["username"] . " " . $_SESSION["lastname"];
    ?>
</body>
</html>
<?php session_destroy(); ?>