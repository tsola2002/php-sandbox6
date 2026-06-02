<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions</title>
</head>
<body>
    <h1>Working With Function</h1>
    <?php
    // BUILT-IN FUNCTIONS
    //phpinfo();

    // DATE FUNCTIONS 
    // echo date('l') ."<br>";
    echo date(" l dS \of F Y h :i :s A") . "<br>";

    // TIME FUNCTIONS
     $timestamp = time();
     echo date('H:i:s', $timestamp) . "<br>";   

     echo date_default_timezone_get() . "<br>";

     date_default_timezone_set('Africa/Lagos');

     echo date('H:i:s', $timestamp) . "<br>";


     // CALENDAR FUNCTIONS 
    $week = cal_to_jd(CAL_GREGORIAN, date("d"), date("m"), date("Y"));
    
    echo $week . "<br>";

    $info = cal_info(0);
    print_r($info);

    // USER DEFINED FUNCTIONS 

    function add($x, $y){
        return $x + $y;
    }

    echo "<br>";
    $result = add(1, 2);
    echo "<br>The Result of The Addition is: " . $result . "<br>";

    function calc_tax($product_category, $product_name, $price){
        if($product_category == "mobile"){
            $total_price = (17.5 / 100) * $price + $price;

            echo "Total price of " . $product_name . " is: $" . $total_price . "<br>";
        }

        if($product_category == "medicine"){
            $total_price = $price;
            echo "Total price of" . $product_name . " is: $" . $total_price . "<br>";
        }
    }

    // $product_category = "mobile";
    // calc_tax($product_category, "Iphone 14 Pro Max", 120000);

    $product_category = "medicine";
    calc_tax($product_category, "Paracetamol", 500);


    ?>
</body>
</html>