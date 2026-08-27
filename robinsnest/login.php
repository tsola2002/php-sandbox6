```php
<?php // login.php

require_once 'header.php';


$error = "";
$user  = "";


/*
|--------------------------------------------------------------------------
| Process Login
|--------------------------------------------------------------------------
*/

if (isset($_POST['user'])) {

    // Username can be trimmed.
    $user = trim($_POST['user']);

    // DO NOT sanitize or modify the password.
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

    } else {


        /*
        |--------------------------------------------------------------------------
        | Find User
        |--------------------------------------------------------------------------
        */

        $stmt = queryMysql(
            "SELECT user, pass
             FROM members
             WHERE user = ?",
            [$user]
        );


        /*
        |--------------------------------------------------------------------------
        | Check User
        |--------------------------------------------------------------------------
        */

        if ($row = $stmt->fetch()) {


            /*
            |--------------------------------------------------------------------------
            | Verify Password
            |--------------------------------------------------------------------------
            |
            | password_verify() compares the plain-text password entered
            | by the user against the secure hash stored in the database.
            |
            */

            if (password_verify($pass, $row['pass'])) {


                /*
                |--------------------------------------------------------------------------
                | Login Successful
                |--------------------------------------------------------------------------
                */

                $_SESSION['user'] = $row['user'];


                /*
                |--------------------------------------------------------------------------
                | Redirect to Members Page
                |--------------------------------------------------------------------------
                */

                echo "
                    <div class='container py-5'>
                        <div class='row justify-content-center'>
                            <div class='col-md-6'>

                                <div class='alert alert-success shadow-sm' role='alert'>

                                    <h4 class='alert-heading'>
                                        Login Successful!
                                    </h4>

                                    <p>
                                        You are now logged in.
                                    </p>

                                    <hr>

                                    <a
                                        href='members.php?view=" .
                                        urlencode($row['user']) .
                                        "&r=" .
                                        htmlspecialchars($randstr) .
                                        "'
                                        class='btn btn-success'
                                    >
                                        Continue
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>

                    </div>
                    </body>
                    </html>
                ";

                exit;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Invalid Login
        |--------------------------------------------------------------------------
        */

        $error = '
            <div class="alert alert-danger" role="alert">
                Invalid username or password.
            </div>
        ';
    }
}

?>


<!--
|--------------------------------------------------------------------------
| Login Page
|--------------------------------------------------------------------------
-->

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm">

                <div class="card-body p-4">

                    <!-- Page Title -->
                    <h3 class="card-title text-center mb-4">
                        Login
                    </h3>


                    <!-- Error -->
                    <?= $error ?>


                    <!-- Login Form -->
                    <form
                        method="post"
                        action="login.php?r=<?= htmlspecialchars($randstr) ?>"
                    >

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
                                value="<?= htmlspecialchars($user) ?>"
                                autocomplete="username"
                                required
                            >

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
                                autocomplete="current-password"
                                required
                            >

                        </div>


                        <!-- Submit -->
                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Login
                            </button>

                        </div>

                    </form>


                    <!-- Signup Link -->
                    <div class="text-center mt-4">

                        <small class="text-muted">
                            Don't have an account?
                        </small>

                        <a
                            href="signup.php"
                            class="text-decoration-none"
                        >
                            Create an account
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


</div>
</body>
</html>
```
