<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Token validation error :(</h1>
    <h2>try to return to the page and enter the data again</h2>
    <a href="<?php if(isset($_SERVER['HTTP_REFERER'])) {echo htmlspecialchars($_SERVER['HTTP_REFERER']);}?>">Go back<a>
</body>
</html>