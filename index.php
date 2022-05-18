<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoS UDP Flood</title>
</head>
<body>
    <form action="./DoS.php" method="POST">
        <div class="dos">
            <label>Hostname:</label>
                <input type="text" name="hostname"><br>
            <label>Port:</label>
                <input type="number" name="port" max=65535 min=1 step=1 value=80><br>
            <button class="button">Start Attack</button>
        </div>
    </form>
</body>
</html>