<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables</title>
</head>
<body>
    <h1>Introduction To Variables in PHP</h1>

    <?php 
        // CREATING A STRING
        $name = 'omatsola sobotie';
        // CREATING A NUMBER
        $num1 = 5;
        $num2 = "5";
        $num3 = 1;
        // CREATING A BOOLEAN
        $trueValue = true;
        // CREATING A FLOAT
        $pi = 3.14;
        // CREATING AN ARRAY
        $colors = ["Red", "Blue", "Green"];
        // CREATING AN OBJECT 
        $user = new stdClass();
        $user->name = "isaac";
        // CREATING A RESOURCE 
        $file = fopen("example.txt", "r");
        // CREATING A NULL DATA TYPE 
        $data = null;

        function greet(){
            return "Hello World";
        }
        // CREATING A CALLEABLE 
        $myFunction = "greet";

        echo $name . "<br>";
        echo $num1 . "<br>";
        echo $trueValue . "<br>";
        echo $pi ."<br>";
        print_r($colors); echo"<br>";
        echo $user->name ."<br>";
        echo $file ."<br>";
        echo $data ."<br>";
        echo $myFunction();


        echo "<h2>Data Types</h2>";
        var_dump($name);
        echo "<br>";
        var_dump($num1);
        echo "<br>";
        var_dump($trueValue);
        echo "<br>";
        var_dump($pi);
        echo "<br>";
        var_dump($colors);
        echo "<br>";
        var_dump($user);
        echo "<br>";
        var_dump($file);
        echo "<br>";
        var_dump($data);
        echo "<br>";
        var_dump($myFunction());



        //DATA CONVERSION
        
        //INTEGER TO STRING CONVERSION
    $convertedString = (string)$num1;

    //STRING TO INTEGER CONVERSION
    $convertedInteger = (int)$num2;

    // FLOAT TO INTEGER CONVERSION
    $convertedFloat = (int)$pi;

    // INTEGER TO BOOLEAN CONVERSION
    $convertedBoolean = (bool)$num3;

    echo "<h2>Converted Data Types</h2>";

    // DISPLAY CONVERTED DATA TYPES
    var_dump($convertedString);
    echo "<br>";
    var_dump($convertedInteger);
    echo "<br>";
    var_dump($convertedFloat);
    echo "<br>";
    var_dump($convertedBoolean);
    echo "<br>";
    

    ?>
</body>
</html>