<?php
require_once 'header.php';

if (isset($_SESSION['user'])) {
    destroySession();
    echo "<div class='alert alert-success text-center'>You have been logged out. <a href='index.php?r=$randstr'>Click here</a> to refresh the screen.</div>";
} else {
    echo "<div class='alert alert-warning text-center'>You cannot log out because you are not logged in.</div>";
}
?>