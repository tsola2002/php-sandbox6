<?php // members.php

require_once 'header.php';

if (!$loggedin) {
    die("</div></body></html>");
}

/*
|--------------------------------------------------------------------------
| View Profile
|--------------------------------------------------------------------------
*/

if (isset($_GET['view'])) {

    $view = trim($_GET['view']);

    if ($view === $user) {
        $name = "Your";
    } else {
        $name = htmlspecialchars($view) . "'s";
    }

    echo '
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-body">

                        <h3 class="card-title mb-4">
                            ' . $name . ' Profile
                        </h3>
    ';

    showProfile($view);

    echo '
                        <div class="d-grid mt-4">
                            <a 
                                href="messages.php?view=' . urlencode($view) . '&r=' . $randstr . '"
                                class="btn btn-primary">
                                View ' . $name . ' messages
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    ';

    die("</div></body></html>");
}


/*
|--------------------------------------------------------------------------
| Add Friend
|--------------------------------------------------------------------------
*/

if (isset($_GET['add'])) {

    $add = trim($_GET['add']);

    // Check if friendship already exists
    $result = queryMysql(
        "SELECT * FROM friends 
         WHERE user = ? AND friend = ?",
        [$add, $user]
    );

    if (!$result->fetch()) {

        queryMysql(
            "INSERT INTO friends (user, friend) VALUES (?, ?)",
            [$add, $user]
        );
    }
}


/*
|--------------------------------------------------------------------------
| Remove Friend
|--------------------------------------------------------------------------
*/

elseif (isset($_GET['remove'])) {

    $remove = trim($_GET['remove']);

    queryMysql(
        "DELETE FROM friends 
         WHERE user = ? AND friend = ?",
        [$remove, $user]
    );
}


/*
|--------------------------------------------------------------------------
| Get All Members
|--------------------------------------------------------------------------
*/

$result = queryMysql(
    "SELECT user FROM members ORDER BY user"
);

$num = $result->rowCount();

?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-7">

            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h2 class="mb-1">Members</h2>
                    <p class="text-muted mb-0">
                        <?= $num ?> member<?= $num != 1 ? 's' : '' ?>
                    </p>
                </div>

            </div>


            <!-- Members List -->
            <div class="list-group shadow-sm">

<?php

while ($row = $result->fetch()) {

    // Don't display the logged-in user
    if ($row['user'] === $user) {
        continue;
    }

    $member = $row['user'];

    /*
    |--------------------------------------------------------------------------
    | Check Relationship
    |--------------------------------------------------------------------------
    */

    // Is this person following me?
    $result1 = queryMysql(
        "SELECT * FROM friends 
         WHERE user = ? AND friend = ?",
        [$member, $user]
    );

    $t1 = $result1->rowCount();


    // Am I following this person?
    $result1 = queryMysql(
        "SELECT * FROM friends 
         WHERE user = ? AND friend = ?",
        [$user, $member]
    );

    $t2 = $result1->rowCount();


    /*
    |--------------------------------------------------------------------------
    | Determine Relationship
    |--------------------------------------------------------------------------
    */

    $follow = "Follow";
    $status = "";
    $statusClass = "text-muted";

    if (($t1 + $t2) > 1) {

        $status = "↔ Mutual friend";
        $statusClass = "text-success";

    } elseif ($t1) {

        $status = "← You are following";
        $statusClass = "text-primary";

    } elseif ($t2) {

        $status = "→ Is following you";
        $statusClass = "text-info";

        $follow = "Follow back";
    }

?>

                <div class="list-group-item">

                    <div class="d-flex justify-content-between align-items-center">

                        <!-- User Information -->
                        <div>

                            <a 
                                href="members.php?view=<?= urlencode($member) ?>&r=<?= $randstr ?>"
                                class="text-decoration-none fw-semibold">

                                <?= htmlspecialchars($member) ?>

                            </a>

                            <?php if ($status): ?>

                                <span class="<?= $statusClass ?> small ms-2">
                                    <?= $status ?>
                                </span>

                            <?php endif; ?>

                        </div>


                        <!-- Action Button -->
                        <div>

                            <?php if (!$t1): ?>

                                <a 
                                    href="members.php?add=<?= urlencode($member) ?>&r=<?= $randstr ?>"
                                    class="btn btn-sm btn-primary">

                                    <?= $follow ?>

                                </a>

                            <?php else: ?>

                                <a 
                                    href="members.php?remove=<?= urlencode($member) ?>&r=<?= $randstr ?>"
                                    class="btn btn-sm btn-outline-danger">

                                    Remove

                                </a>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

<?php

}

?>

            </div>

        </div>

    </div>

</div>

</div>
</body>
</html>
```
