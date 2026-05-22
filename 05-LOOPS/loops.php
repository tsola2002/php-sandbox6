<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loops</title>
</head>
<body>
    <h1>Working With Loops</h1>

    <?php 

    //  WHILE LOOP 
    //     $count = 0;
    // while ($count <= 10) {
    //     echo $count . "<br>";
    //     $count++;
    // }

    // DO WHILE LOOP 
    // $count = 0;
    // do{
    //   echo $count . "<br>";
    // }while(++$count < 10)

    // FOR LOOPS 
    // for( $i = 0; $i <= 10; $i++ ){
    //     echo $i;
    //     echo "<br>";
    // }

    // FOR EACH LOOP 
    $books =  array("Gone with the wind", "Perter Pan", "Harry Potter", "Things Fall Apart");

    foreach ($books as $book) {
        echo $book;
        echo "<br>";
    }


    ?>
</body>
</html>