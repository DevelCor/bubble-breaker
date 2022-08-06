<?php
session_start();
$width = 10;
$height = 10;
$matriz = [];

for ( $i = 0; $i < $width ; $i++ ) {
    for ($j = 0; $j < $height ; $j ++) {
        $matriz[$i][$j] = rand(1, 6);
    }
}

$_SESSION['matriz'] = $matriz;
$_SESSION["puntos"] = 0;


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bubble breaker</title>
</head>
<body>
    <div class="main container">
        <div class="main-title">
            <h1>Bubble Breaker</h1>
        </div>
        <div>
            <a href="nuevo_juego.php">Nuevo juego</a>
        </div>
    </div>
</body>
</html>