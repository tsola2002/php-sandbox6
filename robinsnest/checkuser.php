<?php // checkuser.php

require_once 'functions.php';

if (isset($_POST['user'])) {

    // Get username
    $user = trim($_POST['user']);

    if ($user === '') {
        echo '
            <div class="alert alert-warning py-2 mb-0" role="alert">
                Please enter a username.
            </div>
        ';
        exit;
    }

    // Check if username already exists
    $result = queryMysql(
        "SELECT * FROM members WHERE user = ?",
        [$user]
    );


    if ($result->rowCount()) {

        echo '
            <div class="alert alert-danger py-2 mb-0" role="alert">
                <span class="fw-semibold">
                    &#10060; Username "' .
                    htmlspecialchars($user) .
                    '" is already taken.
                </span>
            </div>
        ';

    } else {

        echo '
            <div class="alert alert-success py-2 mb-0" role="alert">
                <span class="fw-semibold">
                    &#10004; Username "' .
                    htmlspecialchars($user) .
                    '" is available.
                </span>
            </div>
        ';
    }
}
?>

