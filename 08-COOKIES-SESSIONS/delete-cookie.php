<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Cookie</title>
</head>
<body>
    <h1>Deleting A Cookie Value</h1>

    <?php
        // THIS WILL DELETE THE COOKIE 
        setcookie("username", "", time() - 61);

        echo "Hello " . $_COOKIE["username"];
    ?>

</body>
</html>