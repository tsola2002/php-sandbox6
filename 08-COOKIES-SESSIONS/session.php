<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seesion</title>
</head>
<body>
    <h1>Working With Sessions in PHP</h1>

    <?php
        $_SESSION["username"] = "Omatsola";

        $_SESSION["lastname"] = "Sobotie";
    ?>
</body>
</html>