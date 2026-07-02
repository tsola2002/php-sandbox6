<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Session</title>
</head>
<body>
    <h1>Deleting Sessions in PHP</h1>
    <?php 
        // unset all session variables
        $_SESSION = array();
        (ini_get("session.use_cookies"));
        $params = session_get_cookie_params();
        setcookie(session_name(), "", time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]); 
        
        echo "Hello " . $_SESSION["username"] . " " . $_SESSION["lastname"]; 
    ?>
</body>
</html>
<?php session_destroy(); ?>