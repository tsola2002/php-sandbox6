<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operators</title>
</head>
<body>
    <h1>Working With Operators</h1>
    <?php
        $var1 = 10;
        $var2 = 10;

    // ARITHMETIC OPERATORS
    echo "Basic Addition: " . $var1 + $var2 . "<br>";
    echo "Basic Subtraction: " . $var1 - $var2 . "<br>";
     echo "Basic Multiplication: " . $var1 * $var2 . "<br>";
      echo "Basic Division: " . $var1 / $var2 . "<br>";
     echo "Basic Modulus: " . $var1 % $var2 . "<br>";

    ?>

    <p> Plus Equals:
        <?php 
        // ASSIGNMENT OPERATORS
        $a = 3;
        echo $a += 5; //  $a = $a + 5
        ?>
    </p>

    <p> Minus Equals:
        <?php 
        $b = 5;
        echo $b -= 1; //  $b = $b - 1
        ?>
    </p>
    <p> Plus Equals:
        <?php 
        $a = 3;
        echo $a += 5; //  $a = $a + 5
        ?>
    </p>
    <p> Multiply Equals:
        <?php 
        $c = 6;
        echo $c *= 3; //  $c = $c * 3
        ?>
    </p>
    <p> Divide Equals:
        <?php 
        $d = 10;
        echo $d /= 2; //  $d = $d / 2
        ?>
    </p>
    <p> Concatenation Equals:
        <?php 
        // STRING OPERATORS
        $e = "<strong>Hello</strong>";
        echo $e .= " There my friend";
        ?>
    </p>
</body>
</html>