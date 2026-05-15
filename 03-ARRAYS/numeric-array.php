<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numeric Arrays</title>
</head>
<body>
    <h1>Numeric Arrays</h1>
    <?php 
        // CREATING A NUMERIC ARRAY USIGN BUIT-IN ARRAY FUNCTION
    $designation = array("HR", "Developer", "Manager", "Accountant");

    array_push($designation,"Management", "IT");

    $designation2 = ["HR","Developer","Accountant"];

    print_r($designation);
    //echo $designation[3];


    ?>
</body>
</html>