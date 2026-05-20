<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multidimesional Arrays</title>
</head>
<body>
    <h1>Multidimesional Arrays</h1>
    <?php
    $flower_shop = array("category1" => array("Lotus", 12.50, 2), 
    "category2" => array("White Rose", 1.75, 15),
    "category3" => array("Red Rose", 2.15, 8));  
    
    echo $flower_shop["category3"][0] . "<br>";
    echo $flower_shop["category2"][2] ."<br>";

    // USING ASSIGNMENT IN ASSOCIATIVE ARRAYS
    $flower_shop['category2'][0] = 'Pink Rose';

    print_r($flower_shop);

    ?>
</body>
</html>