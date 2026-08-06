<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sending Emails In PHP</h1>

    <form action="send.php" method="post">
        Email: <input type="email" name="email" required><br><br>
        Subject: <input type="text" name="subject" required><br><br>
        Message: <textarea name="message" required></textarea><br><br>
        <input type="submit" value="Send Email">
    </form>
</body>
</html>