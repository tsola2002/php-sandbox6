<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files</title>
</head>
<body>
    <h1>Working with Files in PHP</h1>

    <?php 
        // 1. this code will create a new file document 
    //    if(touch("peter.php")) {
    //         echo "File created successfully";
    //    } else {
    //         echo "File creation failed";
    //    }

    // 2. this code will delete a file document
       if(unlink("peter.php")) {
            echo "File deleted successfully";
       } else {
            echo "File deletion failed";
       }
    ?>
    
</body>
</html>