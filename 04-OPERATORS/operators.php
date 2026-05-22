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

    <?php
        $f = 2;
        echo "Post Increment of 2: " . $f++ . "<br>";

        $g = 2;
        echo "Pre Increment of 2: " . ++$g . "<br>";

        $h = 4;
        echo "Post Decrement of 4: " . $h-- . "<br>";

        $i = 4;
        echo "Pre Decrement of 4: " . --$i . "<br>";

        // COMPARISON OPERATORS 
    
    $j = 10;
    $k = 2;
    $l = 2;
    echo "Loose Equality Operators";
    var_dump("a" == "a");
    echo "<br>";

    echo "Strict Equality Operators";
    var_dump("1" === 1);
    echo "<br>";

    echo "Greater Than Operators";
    var_dump($j > $k);
    echo "<br>";
    

    echo "Less Than Operators";
    var_dump($j < $k);
    echo "<br>";

    echo "Greater Than Equal To Operators";
    var_dump($l >= $k);
    echo "<br>";

    echo "Less Than Equal To Operators";
    var_dump($l <= $k);
    echo "<br>";

    // LOGICAL OPERATORS 
    
    $m = 1;
    $n = 1;
    $o = 0;
    echo "Logical AND Operator";
    var_dump($m AND $n AND $n);
    echo "<br>";

    echo "Logical OR Operator";
    var_dump($m OR $o );
    echo "<br>";

    echo "Not Operator";
    var_dump(!$o);
    echo "<br>";

    echo "Exclusive OR Operator";
    var_dump($m XOR $n);
    echo "<br>";

    // ARRAY OPERATORS 
    echo "<strong>union of m and n</strong>";

    $q = array(1, 2, 3, 4);
    $r = array(5, 6, 7, 8);

        $o = array("a" => "apple", "b" => "ball");
        $p = array("c" => "cat", "d" => "dog");

    $result = $q + $r;

    print_r($result);


    



    ?>
</body>
</html>