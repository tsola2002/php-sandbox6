<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scopes</title>
</head>
<body>
    <h1>Working With Scopes</h1>

    <?php 
        // LOCAL SCOPE
        function test(){
           $name = "Peter";
        echo $name;
        }

        test();
        echo $name;

        // GLOBAL SCOPE 
        // $lastName = "Precious";
        // function show(){
        //     global $lastName;
        //     echo $lastName;
        // }

        // show();

        // STATIC SCOPE
        function counter(){
            static $count = 0;
            $count++;
            echo $count;
        }

        counter();
        counter();
        counter();

    ?>
</body>
</html>