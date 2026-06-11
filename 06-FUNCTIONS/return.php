<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return</title>
</head>
<body>
    <h1>Working With Return Values</h1>
    <?php 
        function add($a, $b){
            return $a + $b;
        }
        $result = add(5, 10);
        var_dump($result);
    ?>
</body>
</html>