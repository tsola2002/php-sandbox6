<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Form Processing Page</h1>

    <?php 

        $errors = [];

        // Validate each field
        if (empty($_POST['name'])) {
            $errors[] = "Name is required.";
        }

        if (empty($_POST['email'])) {
            $errors[] = "Email is required.";
        }

        if (empty($_POST['password'])) {
            $errors[] = "Password is required.";
        }

        if (empty($_POST['dob'])) {
            $errors[] = "Date of Birth is required.";
        }

        // If there are validation errors
        if (!empty($errors)) {

            echo "<h3>Please correct the following errors:</h3>";

            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }

        } else {

            // Pick out key values from the superglobal
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dob = $_POST['dob'];

            // Display submitted data
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Password:</strong> $password</p>";
            echo "<p><strong>Date Of Birth:</strong> $dob</p>";
        }

    ?>
</body>
</html>