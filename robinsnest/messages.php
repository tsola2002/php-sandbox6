<?php // messages.php

require_once 'header.php';

if (!$loggedin) {
    die("</div></body></html>");
}


/*
|--------------------------------------------------------------------------
| Determine Which User's Messages We're Viewing
|--------------------------------------------------------------------------
*/

if (isset($_GET['view'])) {
    $view = trim($_GET['view']);
} else {
    $view = $user;
}


/*
|--------------------------------------------------------------------------
| Post New Message
|--------------------------------------------------------------------------
*/

if (isset($_POST['text'])) {

    $text = trim($_POST['text']);

    if ($text !== "") {

        $pm = isset($_POST['pm']) ? substr($_POST['pm'], 0, 1) : "0";

        $time = time();

        queryMysql(
            "INSERT INTO messages (auth, recip, pm, time, message)
             VALUES (?, ?, ?, ?, ?)",
            [$user, $view, $pm, $time, $text]
        );
    }
}


/*
|--------------------------------------------------------------------------
| Display Messages
|--------------------------------------------------------------------------
*/

if ($view !== "") {

    if ($view === $user) {

        $name1 = "Your";
        $name2 = "Your";

    } else {

        $name1 = "
            <a 
                href='members.php?view=" . urlencode($view) . "&r=$randstr'
                class='text-decoration-none'>
                " . htmlspecialchars($view) . "
            </a>'s
        ";

        $name2 = htmlspecialchars($view) . "'s";
    }

?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-7">

            <!-- Page Header -->
            <div class="mb-4">

                <h3 class="mb-3">
                    <?= $name1 ?> Messages
                </h3>

                <div class="card shadow-sm">

                    <div class="card-body">

                        <?php
                        // Display profile
                        showProfile($view);
                        ?>

                    </div>

                </div>

            </div>


            <!-- Message Form -->
            <div class="card shadow-sm mb-4">

                <div class="card-header">
                    <h5 class="mb-0">
                        Leave a Message
                    </h5>
                </div>

                <div class="card-body">

                    <form 
                        method="post"
                        action="messages.php?view=<?= urlencode($view) ?>&r=<?= $randstr ?>"
                    >

                        <!-- Message Visibility -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Message Type
                            </label>

                            <div class="d-flex gap-3">

                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="pm"
                                        id="public"
                                        value="0"
                                        checked
                                    >

                                    <label
                                        class="form-check-label"
                                        for="public"
                                    >
                                        Public
                                    </label>

                                </div>


                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="pm"
                                        id="private"
                                        value="1"
                                    >

                                    <label
                                        class="form-check-label"
                                        for="private"
                                    >
                                        Private
                                    </label>

                                </div>

                            </div>

                        </div>


                        <!-- Message Text -->
                        <div class="mb-3">

                            <label
                                for="message"
                                class="form-label fw-semibold"
                            >
                                Your Message
                            </label>

                            <textarea
                                name="text"
                                id="message"
                                class="form-control"
                                rows="4"
                                placeholder="Type your message here..."
                                required
                            ></textarea>

                        </div>


                        <!-- Submit -->
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Post Message
                        </button>

                    </form>

                </div>

            </div>


<?php

    /*
    |--------------------------------------------------------------------------
    | Delete Message
    |--------------------------------------------------------------------------
    */

    date_default_timezone_set('UTC');

    if (isset($_GET['erase'])) {

        $erase = (int) $_GET['erase'];

        queryMysql(
            "DELETE FROM messages
             WHERE id = ? AND recip = ?",
            [$erase, $user]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Retrieve Messages
    |--------------------------------------------------------------------------
    */

    $result = queryMysql(
        "SELECT *
         FROM messages
         WHERE recip = ?
         ORDER BY time DESC",
        [$view]
    );

    $num = $result->rowCount();

?>


            <!-- Messages Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">

                <h4 class="mb-0">
                    Messages
                </h4>

                <span class="badge bg-secondary">
                    <?= $num ?>
                </span>

            </div>


<?php

    /*
    |--------------------------------------------------------------------------
    | Display Messages
    |--------------------------------------------------------------------------
    */

    while ($row = $result->fetch()) {

        if (
            $row['pm'] == 0 ||
            $row['auth'] === $user ||
            $row['recip'] === $user
        ) {

            $author = htmlspecialchars($row['auth']);
            $message = htmlspecialchars($row['message']);

            $date = date(
                'M jS \'y g:ia',
                $row['time']
            );

?>

            <div class="card shadow-sm mb-3">

                <div class="card-body">

                    <!-- Message Header -->
                    <div class="d-flex justify-content-between align-items-start mb-2">

                        <div>

                            <a
                                href="members.php?view=<?= urlencode($row['auth']) ?>&r=<?= $randstr ?>"
                                class="fw-semibold text-decoration-none"
                            >
                                <?= $author ?>
                            </a>

                            <?php if ($row['pm'] == 0): ?>

                                <span class="badge bg-primary ms-2">
                                    Public
                                </span>

                            <?php else: ?>

                                <span class="badge bg-warning text-dark ms-2">
                                    Private
                                </span>

                            <?php endif; ?>

                        </div>


                        <small class="text-muted">
                            <?= $date ?>
                        </small>

                    </div>


                    <!-- Message -->
                    <p class="mb-3">

                        <?php if ($row['pm'] == 0): ?>

                            <span class="text-muted">
                                wrote:
                            </span>

                            &quot;<?= $message ?>&quot;

                        <?php else: ?>

                            <span class="text-muted">
                                whispered:
                            </span>

                            <span class="text-primary fst-italic">
                                &quot;<?= $message ?>&quot;
                            </span>

                        <?php endif; ?>

                    </p>


                    <!-- Erase Button -->
                    <?php if ($row['recip'] === $user): ?>

                        <a
                            href="messages.php?view=<?= urlencode($view) ?>&erase=<?= (int) $row['id'] ?>&r=<?= $randstr ?>"
                            class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Are you sure you want to erase this message?');"
                        >
                            Erase
                        </a>

                    <?php endif; ?>

                </div>

            </div>

<?php

        }
    }


    /*
    |--------------------------------------------------------------------------
    | No Messages
    |--------------------------------------------------------------------------
    */

    if (!$num) {

?>

            <div class="alert alert-info text-center">

                <i class="bi bi-chat-dots"></i>
                No messages yet.

            </div>

<?php

    }

?>

            <!-- Refresh -->
            <div class="d-grid mt-4">

                <a
                    href="messages.php?view=<?= urlencode($view) ?>&r=<?= $randstr ?>"
                    class="btn btn-outline-primary"
                >
                    Refresh Messages
                </a>

            </div>

        </div>

    </div>

</div>

<?php
}

?>

</div>
</body>
</html>

