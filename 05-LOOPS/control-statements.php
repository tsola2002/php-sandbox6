<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Statements</title>
</head>
<body>
    <h1>Working With Control Statements</h1>

    <?php 

        // IF STATEMENT 
        // $age = 5;
        // if($age > 18){
        //     echo "You're an Adult now";          
        // } elseif($age > 8) {
        //     echo "You're very young";
        // } else {
        //     echo "You're still a Baby!!!";
        // }


        // SWITCH STATEMENT
        $day = 5;

    switch ($day) {
        case 1: 
            echo "The day is sunday";
            break;
        case 2: 
            echo "The day is monday";
            break;
        case 3: 
            echo "The day is tuesday";
            break;
        case 4: 
            echo "The day is wednesday";
            break;
        case 5: 
            echo "The day is thursday";
            break;
        case 6: 
            echo "The day is fridsyday";
            break;
        case 7: 
            echo "The day is saturday";
            break;
    }
    
    
       
    
    ?>
</body>
</html>