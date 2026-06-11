<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous</title>
</head>
<body>
    <h1>Working With Anonymous Functions</h1>

    <?php 

    // ANONYMOUS FUNCTION
    $add = function ($a, $b) {
        return $a + $b;
    };

    echo $add(5, 10) . "<br>";

    //     function  greet (){
    //         echo "Hello World";
    //     }

    // greet();




    // WITHOUT CLOSURES 
    // $message = "Heelo From Closure";

    // $show = function(){
    //     echo $message;
    // };

    // $show();

    $name = "Omatsola";
    $age = 30;

    $show = function() use($name, $age){
        echo "My name is $name and I am $age years old";
    };

    $show();

    ?>



</body>
</html>