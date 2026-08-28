<?php // messages.php

require_once 'header.php';


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

if (!$loggedin) {
    die("</div></body></html>");
}


/*
|--------------------------------------------------------------------------
| Determine Profile Being Viewed
|--------------------------------------------------------------------------
*/

if (isset($_GET['view'])) {

    $view = trim($_GET['view']);

} else {

    $view = $user;
}


/*
|--------------------------------------------------------------------------
| Make Sure User Exists
|--------------------------------------------------------------------------
*/

$stmt = queryMysql(
    "SELECT user FROM members WHERE user = ?",
    [$view]
);

if (!$stmt->fetch()) {

    echo '
        <div class="container py-5">

            <div class="alert alert-danger">
                User not found.
            </div>

        </div>
    ';

    die("</div></body></html>");
}


/*
|--------------------------------------------------------------------------
| Delete Message
|--------------------------------------------------------------------------
*/

if (isset($_GET['erase'])) {

    $erase = (int) $_GET['erase'];

    queryMysql(
        "DELETE FROM messages
         WHERE id = ?
         AND recip = ?",
        [$erase, $user]
    );

}


/*
|--------------------------------------------------------------------------
| Send Message
|--------------------------------------------------------------------------
*/

$messageError = "";
$messageSuccess = "";


if (isset($_POST['text'])) {

    $text = trim($_POST['text']);

    $pm = isset($_POST['pm'])
        ? (int) $_POST['pm']
        : 0;


    /*
    |--------------------------------------------------------------------------
    | Validate Message
    |--------------------------------------------------------------------------
    */

    if ($text === "") {

        $messageError = "Please enter a message.";

    } elseif (strlen($text) > 4096) {

        $messageError = "Your message is too long.";

    } else {


        /*
        |--------------------------------------------------------------------------
        | Insert Message
        |--------------------------------------------------------------------------
        */

        queryMysql(
            "INSERT INTO messages
            (auth, recip, pm, time, message)
            VALUES (?, ?, ?, ?, ?)",
            [
                $user,
                $view,
                $pm,
                time(),
                $text
            ]
        );


        $messageSuccess = "Message posted successfully.";
    }
}


/*
|--------------------------------------------------------------------------
| Profile Name
|--------------------------------------------------------------------------
*/

if ($view === $user) {

    $profileName = "Your";
    $profileTitle = "Your Messages";

} else {

    $profileName = htmlspecialchars($view);
    $profileTitle = htmlspecialchars($view) . "'s Messages";
}


/*
|--------------------------------------------------------------------------
| Retrieve Profile Information
|--------------------------------------------------------------------------
*/

$profileStmt = queryMysql(
    "SELECT text
     FROM profiles
     WHERE user = ?",
    [$view]
);

$profile = $profileStmt->fetch();


/*
|--------------------------------------------------------------------------
| Retrieve Profile Image
|--------------------------------------------------------------------------
*/

$imagePath = $view . '.jpg';

?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-9 col-lg-8">


            <!-- ==========================================================
                 PROFILE CARD
            =========================================================== -->

            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <div class="text-center">


                        <!-- Profile Image -->

                        <?php if (file_exists($imagePath)): ?>

                            <img
                                src="<?= htmlspecialchars($imagePath) ?>"
                                alt="<?= htmlspecialchars($view) ?>"
                                class="rounded-circle img-fluid shadow-sm mb-3"
                                style="
                                    width: 130px;
                                    height: 130px;
                                    object-fit: cover;
                                "
                            >

                        <?php else: ?>

                            <div
                                class="rounded-circle bg-light
                                       d-flex align-items-center
                                       justify-content-center
                                       mx-auto mb-3 shadow-sm"
                                style="
                                    width: 130px;
                                    height: 130px;
                                "
                            >

                                <i class="bi bi-person fs-1 text-secondary"></i>

                            </div>

                        <?php endif; ?>


                        <!-- Profile Name -->

                        <h2 class="mb-2">

                            <?= $profileName ?>

                        </h2>


                        <!-- Profile Description -->

                        <?php if ($profile): ?>

                            <p class="text-muted mb-3">

                                <?= nl2br(
                                    htmlspecialchars(
                                        stripslashes($profile['text'])
                                    )
                                ) ?>

                            </p>

                        <?php else: ?>

                            <p class="text-muted mb-3">

                                No profile description available.

                            </p>

                        <?php endif; ?>


                        <!-- View Profile Button -->

                        <a
                            href="members.php?view=<?= urlencode($view) ?>&r=<?= $randstr ?>"
                            class="btn btn-outline-primary btn-sm"
                        >
                            <i class="bi bi-person"></i>
                            View Profile
                        </a>

                    </div>

                </div>

            </div>



            <!-- ==========================================================
                 MESSAGE FORM
            =========================================================== -->

            <div class="card shadow-sm mb-4">

                <div class="card-header">

                    <h5 class="mb-0">

                        <i class="bi bi-chat-left-text"></i>

                        Send a Message

                    </h5>

                </div>


                <div class="card-body">


                    <!-- Success -->

                    <?php if ($messageSuccess): ?>

                        <div
                            class="alert alert-success alert-dismissible fade show"
                            role="alert"
                        >

                            <?= htmlspecialchars($messageSuccess) ?>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                            ></button>

                        </div>

                    <?php endif; ?>


                    <!-- Error -->

                    <?php if ($messageError): ?>

                        <div
                            class="alert alert-danger"
                            role="alert"
                        >

                            <?= htmlspecialchars($messageError) ?>

                        </div>

                    <?php endif; ?>


                    <form
                        method="post"
                        action="messages.php?view=<?= urlencode($view) ?>&r=<?= $randstr ?>"
                    >


                        <!-- Message Type -->

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Message Type

                            </label>


                            <div class="d-flex gap-4">


                                <!-- Public -->

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

                                        <i class="bi bi-globe"></i>

                                        Public

                                    </label>

                                </div>


                                <!-- Private -->

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

                                        <i class="bi bi-lock"></i>

                                        Private

                                    </label>

                                </div>

                            </div>

                        </div>


                        <!-- Message -->

                        <div class="mb-3">

                            <label
                                for="message"
                                class="form-label fw-semibold"
                            >

                                Message

                            </label>

                            <textarea
                                name="text"
                                id="message"
                                class="form-control"
                                rows="4"
                                maxlength="4096"
                                placeholder="Write a message to <?= htmlspecialchars($view) ?>..."
                                required
                            ></textarea>

                        </div>


                        <!-- Submit -->

                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-send"></i>

                                Send Message

                            </button>

                        </div>

                    </form>

                </div>

            </div>



            <!-- ==========================================================
                 MESSAGES
            =========================================================== -->

<?php

/*
|--------------------------------------------------------------------------
| Retrieve Messages
|--------------------------------------------------------------------------
|
| Public messages are visible to everyone.
|
| Private messages are visible only to:
|
| 1. The person who sent them
| 2. The person who received them
|
*/

$messageStmt = queryMysql(
    "SELECT *
     FROM messages
     WHERE recip = ?
     ORDER BY time DESC",
    [$view]
);


$messages = [];

while ($row = $messageStmt->fetch()) {

    /*
    |--------------------------------------------------------------------------
    | Public Message
    |--------------------------------------------------------------------------
    */

    if ((int)$row['pm'] === 0) {

        $messages[] = $row;

    }


    /*
    |--------------------------------------------------------------------------
    | Private Message
    |--------------------------------------------------------------------------
    |
    | Only the sender or recipient can see it.
    |
    */

    elseif (
        $row['auth'] === $user ||
        $row['recip'] === $user
    ) {

        $messages[] = $row;
    }
}

?>


            <!-- Messages Header -->

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h4 class="mb-0">

                    <i class="bi bi-chat-dots"></i>

                    <?= $profileTitle ?>

                </h4>


                <span class="badge bg-primary rounded-pill">

                    <?= count($messages) ?>

                </span>

            </div>



<?php if (count($messages) > 0): ?>


<?php foreach ($messages as $row): ?>


                <!-- ======================================================
                     MESSAGE CARD
                ======================================================= -->

                <div class="card shadow-sm mb-3">

                    <div class="card-body">


                        <!-- Message Header -->

                        <div
                            class="d-flex justify-content-between
                                   align-items-start mb-3"
                        >

                            <div>

                                <a
                                    href="members.php?view=<?= urlencode($row['auth']) ?>&r=<?= $randstr ?>"
                                    class="fw-semibold text-decoration-none"
                                >

                                    <?= htmlspecialchars($row['auth']) ?>

                                </a>


                                <?php if ((int)$row['pm'] === 0): ?>

                                    <span class="badge bg-success ms-2">

                                        <i class="bi bi-globe"></i>

                                        Public

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-warning text-dark ms-2">

                                        <i class="bi bi-lock"></i>

                                        Private

                                    </span>

                                <?php endif; ?>

                            </div>


                            <small class="text-muted">

                                <?= date(
                                    'M jS \'y g:ia',
                                    $row['time']
                                ) ?>

                            </small>

                        </div>



                        <!-- Message Text -->

                        <div class="bg-light rounded p-3 mb-3">

                            <?php if ((int)$row['pm'] === 0): ?>

                                <div class="text-muted small mb-1">

                                    <i class="bi bi-chat-quote"></i>

                                    wrote:

                                </div>

                            <?php else: ?>

                                <div class="text-muted small mb-1">

                                    <i class="bi bi-lock"></i>

                                    whispered:

                                </div>

                            <?php endif; ?>


                            <div class="message-content">

                                <?= nl2br(
                                    htmlspecialchars($row['message'])
                                ) ?>

                            </div>

                        </div>



                        <!-- Message Actions -->

                        <?php if ($row['recip'] === $user): ?>

                            <a
                                href="messages.php?view=<?= urlencode($view) ?>&erase=<?= (int)$row['id'] ?>&r=<?= $randstr ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this message?');"
                            >

                                <i class="bi bi-trash"></i>

                                Delete

                            </a>

                        <?php endif; ?>


                    </div>

                </div>


<?php endforeach; ?>


<?php else: ?>


                <!-- No Messages -->

                <div class="card shadow-sm">

                    <div class="card-body text-center py-5">

                        <i
                            class="bi bi-chat-square-text
                                   display-4 text-muted"
                        ></i>

                        <h5 class="mt-3">

                            No messages yet

                        </h5>

                        <p class="text-muted mb-0">

                            Be the first person to leave a message.

                        </p>

                    </div>

                </div>


<?php endif; ?>



            <!-- ==========================================================
                 REFRESH
            =========================================================== -->

            <div class="d-grid mt-4 mb-5">

                <a
                    href="messages.php?view=<?= urlencode($view) ?>&r=<?= $randstr ?>"
                    class="btn btn-outline-primary"
                >

                    <i class="bi bi-arrow-clockwise"></i>

                    Refresh Messages

                </a>

            </div>


        </div>

    </div>

</div>


</div>
</body>
</html>

