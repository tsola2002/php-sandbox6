<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>try/catch</title>
</head>
<body>
    <h1>Working with try/catch in PHP</h1>
    <?php
        function numberCheck($num){
            if($num > 2){
            throw new Exception("Value must be equal to or less than 2");
            
            }
            return true;
        }
 
       try{
            numberCheck(3);         
       } catch(Exception $e){
          echo 'message: ' .$e->getFile();
       }
    ?>

</body>
</html>