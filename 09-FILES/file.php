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
    //    if(unlink("peter.php")) {
    //         echo "File deleted successfully";
    //    } else {
    //         echo "File deletion failed";
    //    }

    // 3. Wriing to a file document

        // $file = fopen("peter.php", "a");
        // $data = "We just added this content to peter.php \n";
        // fwrite($file, $data);
        // fclose($file);


     // 4.  create an add content at the same time
    //  file_put_contents("peter.php", "We just added this content to peter.php \n", FILE_APPEND);
     
     // 5. reading contents of the file
    //  $resource  = fopen("peter.php", "r");
    //  $content = fread($resource, filesize("peter.php"));
    //  fclose($resource);

    // echo $content;

    // 6. creating a folder
    //   if(mkdir("my-folder")) {
    //     echo "Folder was created";
    //   } else {
    //     echo "folder was not created";
    //   }

    // 7. Deleting a folder
        // rmdir("my-folder");
    ?>
    
</body>
</html>