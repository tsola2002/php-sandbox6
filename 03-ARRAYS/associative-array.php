<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associative Arrays</title>
</head>
<body>
    <h1>Associative Arrays</h1>
    <?php 
        // CREATING AN ASSOCIATIVE ARRAY
        // $details = array("E101" => 20000, "E102" => 15000, "E103" => 25000);

        $details = ["E101" => 20000, "E102" => 15000, "E103" => 25000];

        //print_r($details);
    
        echo $details["E101"];

    ?>
</body>
</html>