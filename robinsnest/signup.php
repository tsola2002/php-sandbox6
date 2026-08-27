```php
<?php // signup.php

require_once 'header.php';


/*
|--------------------------------------------------------------------------
| Check Username Availability
|--------------------------------------------------------------------------
|
| checkuser.php handles the AJAX request separately.
|
*/


$error = "";
$user  = "";


/*
|--------------------------------------------------------------------------
| Destroy Existing Session
|--------------------------------------------------------------------------
*/

if (isset($_SESSION['user'])) {
    destroySession();
}


/*
|--------------------------------------------------------------------------
| Process Signup Form
|--------------------------------------------------------------------------
*/

if (isset($_POST['user'])) {

    // Username can be trimmed.
    $user = trim($_POST['user']);

    // DO NOT sanitize/modify the password.
    $pass = $_POST['pass'] ?? "";


    /*
    |--------------------------------------------------------------------------
    | Validate Input
    |--------------------------------------------------------------------------
    */

    if ($user === "" || $pass === "") {

        $error = '
            <div class="alert alert-danger" role="alert">
                Not all fields were entered.
            </div>
        ';

    } elseif (strlen($user) > 16) {

        $error = '
            <div class="alert alert-danger" role="alert">
                Username must not be more than 16 characters.
            </div>
        ';

    } elseif (strlen($pass) > 72) {

        $error = '
            <div class="alert alert-danger" role="alert">
                Password must not be more than 72 characters.
            </div>
        ';

    } else {


        /*
        |--------------------------------------------------------------------------
        | Check Whether Username Already Exists
        |--------------------------------------------------------------------------
        */

        $result = queryMysql(
            "SELECT user FROM members WHERE user = ?",
            [$user]
        );


        if ($result->fetch()) {

            $error = '
                <div class="alert alert-danger" role="alert">
                    That username already exists.
                </div>
            ';

        } else {


            /*
            |--------------------------------------------------------------------------
            | Hash Password
            |--------------------------------------------------------------------------
            |
            | password_hash() creates a secure one-way password hash.
            |
            */

            $hashedPassword = password_hash(
                $pass,
                PASSWORD_DEFAULT
            );


            /*
            |--------------------------------------------------------------------------
            | Check Hashing Was Successful
            |--------------------------------------------------------------------------
            */

            if ($hashedPassword === false) {

                $error = '
                    <div class="alert alert-danger" role="alert">
                        Unable to create your account. Please try again.
                    </div>
                ';

            } else {


                /*
                |--------------------------------------------------------------------------
                | Insert User
                |--------------------------------------------------------------------------
                */

                queryMysql(
                    "INSERT INTO members (user, pass)
                     VALUES (?, ?)",
                    [$user, $hashedPassword]
                );


                /*
                |--------------------------------------------------------------------------
                | Account Created
                |--------------------------------------------------------------------------
                */

                die("
                    <div class='container py-5'>
                        <div class='row justify-content-center'>
                            <div class='col-md-6'>

                                <div class='alert alert-success shadow-sm' role='alert'>

                                    <h4 class='alert-heading'>
                                        Account Created!
                                    </h4>

                                    <p>
                                        Your account has been created successfully.
                                    </p>

                                    <hr>

                                    <p class='mb-0'>
                                        <a href='login.php' class='btn btn-success'>
                                            Log In
                                        </a>
                                    </p>

                                </div>

                            </div>
                        </div>
                    </div>

                    </div>
                    </body>
                    </html>
                ");
            }
        }
    }
}

?>


<!--
|--------------------------------------------------------------------------
| Signup Page
|--------------------------------------------------------------------------
-->

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm">

                <div class="card-body p-4">

                    <!-- Page Title -->
                    <h3 class="card-title text-center mb-4">
                        Create Account
                    </h3>


                    <!-- Error Message -->
                    <?= $error ?>


                    <!-- Signup Form -->
                    <form
                        method="post"
                        action="signup.php?r=<?= htmlspecialchars($randstr) ?>"
                    >

                        <!-- Introduction -->
                        <div class="alert alert-info" role="alert">

                            Please enter your details to sign up.

                        </div>


                        <!-- Username -->
                        <div class="mb-3">

                            <label
                                for="username"
                                class="form-label fw-semibold"
                            >
                                Username
                            </label>

                            <input
                                type="text"
                                id="username"
                                name="user"
                                class="form-control"
                                maxlength="16"
                                value="<?= htmlspecialchars($user) ?>"
                                onblur="checkUser(this)"
                                required
                            >

                            <!-- Username Availability -->
                            <div
                                id="used"
                                class="mt-2"
                                aria-live="polite"
                            ></div>

                        </div>


                        <!-- Password -->
                        <div class="mb-4">

                            <label
                                for="password"
                                class="form-label fw-semibold"
                            >
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="pass"
                                class="form-control"
                                maxlength="72"
                                autocomplete="new-password"
                                required
                            >

                            <div class="form-text">
                                Your password will be securely hashed before
                                being stored in the database.
                            </div>

                        </div>


                        <!-- Submit -->
                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Sign Up
                            </button>

                        </div>

                    </form>


                    <!-- Login Link -->
                    <div class="text-center mt-4">

                        <small class="text-muted">
                            Already have an account?
                        </small>

                        <a
                            href="login.php"
                            class="text-decoration-none"
                        >
                            Log in
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
function checkUser(user)
{
    const used = document.getElementById('used');

    if (user.value.trim() === '') {
        used.innerHTML = '';
        return;
    }

    fetch('checkuser.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'user=' + encodeURIComponent(user.value)
    })
    .then(response => response.text())
    .then(data => {
        used.innerHTML = data;
    })
    .catch(error => {
        used.innerHTML = `
            <div class="alert alert-warning py-2 mb-0">
                Unable to check username.
            </div>
        `;
    });
}
</script>


</div>
</body>
</html>
```
