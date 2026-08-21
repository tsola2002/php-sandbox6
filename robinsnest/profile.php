<?php // profile.php

require_once 'header.php';

if (!$loggedin) {
    die("</div></body></html>");
}


/*
|--------------------------------------------------------------------------
| Get Current Profile
|--------------------------------------------------------------------------
*/

$result = queryMysql(
    "SELECT * FROM profiles WHERE user = ?",
    [$user]
);


/*
|--------------------------------------------------------------------------
| Save Profile Text
|--------------------------------------------------------------------------
*/

if (isset($_POST['text'])) {

    $text = trim($_POST['text']);

    // Remove excessive whitespace
    $text = preg_replace('/\s+/', ' ', $text);

    if ($result->rowCount()) {

        // Update existing profile
        queryMysql(
            "UPDATE profiles SET text = ? WHERE user = ?",
            [$text, $user]
        );

    } else {

        // Create new profile
        queryMysql(
            "INSERT INTO profiles (user, text) VALUES (?, ?)",
            [$user, $text]
        );
    }

} else {

    /*
    |--------------------------------------------------------------------------
    | Load Existing Profile
    |--------------------------------------------------------------------------
    */

    if ($result->rowCount()) {

        $row = $result->fetch();
        $text = $row['text'];

    } else {

        $text = "";
    }
}


/*
|--------------------------------------------------------------------------
| Clean Profile Text
|--------------------------------------------------------------------------
*/

$text = stripslashes(
    preg_replace('/\s+/', ' ', $text)
);


/*
|--------------------------------------------------------------------------
| Handle Profile Image Upload
|--------------------------------------------------------------------------
*/

if (
    isset($_FILES['image']) &&
    $_FILES['image']['error'] === UPLOAD_ERR_OK
) {

    $saveto = "$user.jpg";

    /*
    |--------------------------------------------------------------------------
    | Move Uploaded File
    |--------------------------------------------------------------------------
    */

    if (move_uploaded_file(
        $_FILES['image']['tmp_name'],
        $saveto
    )) {

        $typeok = true;
        $src = null;

        /*
        |--------------------------------------------------------------------------
        | Determine Image Type
        |--------------------------------------------------------------------------
        */

        switch ($_FILES['image']['type']) {

            case "image/gif":
                $src = imagecreatefromgif($saveto);
                break;

            case "image/jpeg":
            case "image/pjpeg":
                $src = imagecreatefromjpeg($saveto);
                break;

            case "image/png":
                $src = imagecreatefrompng($saveto);
                break;

            default:
                $typeok = false;
                break;
        }


        /*
        |--------------------------------------------------------------------------
        | Resize Image
        |--------------------------------------------------------------------------
        */

        if ($typeok && $src !== false) {

            $imageInfo = getimagesize($saveto);

            $w = $imageInfo[0];
            $h = $imageInfo[1];

            $max = 100;

            $tw = $w;
            $th = $h;


            // Landscape
            if ($w > $h && $w > $max) {

                $tw = $max;
                $th = ($max / $w) * $h;

            }

            // Portrait
            elseif ($h > $w && $h > $max) {

                $th = $max;
                $tw = ($max / $h) * $w;

            }

            // Square
            elseif ($w >= $max) {

                $tw = $th = $max;
            }


            /*
            |--------------------------------------------------------------------------
            | Create Resized Image
            |--------------------------------------------------------------------------
            */

            $tmp = imagecreatetruecolor(
                (int) $tw,
                (int) $th
            );


            imagecopyresampled(
                $tmp,
                $src,
                0,
                0,
                0,
                0,
                (int) $tw,
                (int) $th,
                $w,
                $h
            );


            /*
            |--------------------------------------------------------------------------
            | Sharpen Image
            |--------------------------------------------------------------------------
            */

            imageconvolution(
                $tmp,
                [
                    [-1, -1, -1],
                    [-1, 16, -1],
                    [-1, -1, -1]
                ],
                8,
                0
            );


            /*
            |--------------------------------------------------------------------------
            | Save JPEG
            |--------------------------------------------------------------------------
            */

            imagejpeg(
                $tmp,
                $saveto,
                90
            );


            imagedestroy($tmp);
            imagedestroy($src);
        }
    }
}


/*
|--------------------------------------------------------------------------
| Page
|--------------------------------------------------------------------------
*/

?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-7">

            <!-- Page Header -->
            <div class="mb-4">

                <h2 class="mb-1">
                    Your Profile
                </h2>

                <p class="text-muted mb-0">
                    Update your profile information and profile picture.
                </p>

            </div>


            <!-- Current Profile -->
            <div class="card shadow-sm mb-4">

                <div class="card-header">

                    <h5 class="mb-0">
                        Current Profile
                    </h5>

                </div>

                <div class="card-body">

                    <?php showProfile($user); ?>

                </div>

            </div>


            <!-- Edit Profile -->
            <div class="card shadow-sm">

                <div class="card-header">

                    <h5 class="mb-0">
                        Edit Profile
                    </h5>

                </div>

                <div class="card-body">

                    <p class="text-muted">
                        Enter or edit your profile details and upload a
                        profile image.
                    </p>


                    <form
                        method="post"
                        action="profile.php?r=<?= $randstr ?>"
                        enctype="multipart/form-data"
                    >

                        <!-- Profile Text -->
                        <div class="mb-4">

                            <label
                                for="profileText"
                                class="form-label fw-semibold"
                            >
                                About You
                            </label>

                            <textarea
                                name="text"
                                id="profileText"
                                class="form-control"
                                rows="6"
                                placeholder="Tell other members something about yourself..."
                            ><?= htmlspecialchars($text) ?></textarea>

                            <div class="form-text">
                                Write a short description about yourself.
                            </div>

                        </div>


                        <!-- Profile Image -->
                        <div class="mb-4">

                            <label
                                for="profileImage"
                                class="form-label fw-semibold"
                            >
                                Profile Image
                            </label>

                            <input
                                type="file"
                                name="image"
                                id="profileImage"
                                class="form-control"
                                accept="image/jpeg,image/png,image/gif"
                            >

                            <div class="form-text">
                                Supported formats: JPG, PNG and GIF.
                            </div>

                        </div>


                        <!-- Save Button -->
                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Save Profile
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</div>
</body>
</html>

