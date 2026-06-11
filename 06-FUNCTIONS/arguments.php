<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Passing Arguments by reference and Value</h1>

    <?php 
    // PASSING ARGUMENTS BY VALUE 

    // function increase($number){
    //     $number++;
    // }
    // $x = 5; // $x ex10005
    // increase($x); // $x nx10058
    // echo $x . "<br>";

     // PASSING ARGUMENTS BY REFERENCE
     function increase(&$number){
         $number++;
     }
     $x = 5; // $x ex10005
     increase($x); // $x ex10005
     echo $x . "<br>";
    ?>
</body>
</html>