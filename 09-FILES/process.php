<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Handler</title>
</head>
<body>
    <?php

       if(isset($_POST["submit"])){

            // defining the target directory
            $targetDir = "uploads/";
            $fileName = basename($_FILES['photo']['name']);

            $targetFile = $targetDir . $fileName;

            // UPLOAD FILE 
           if(move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)){
                echo "<h3>File uploaded succesfuly</h3>";
                echo "<img src='$targetFile' alt='Uploaded photo' style='width: 300px'/>";

           } else {
            echo "<h3>Sorry, There was an error uploading your file</h3>";
           }

       } 

        
    
    ?>
</body>
</html>