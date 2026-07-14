<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h1>File  Upload</h1>

    <form method="post" action="process.php" enctype="multipart/form-data">
        Name: <input type="text" name="name"> <br>
        Upload a Photo: <input type="file" name="photo" required><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>