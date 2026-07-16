<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigger Error</title>
</head>
<body>
    </h1>Triggering Errors in PHP</h1>
    <?php
    
        function calcAverage($totalMarks, $noOfSubjects){
            if($noOfSubjects == 0){
                trigger_error("sholas triggered error: The number of subjects cannot be zero", E_USER_NOTICE);
                return false;
            } else {
                return $totalMarks / $noOfSubjects;
            }
        }

        echo calcAverage(400, 0);
    ?>
</body>
</html>