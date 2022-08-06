<?php
//echo "<td><button type='submit' name='bubble'/> <img src='assets/".$mat[$i][$j].".png'> </button></td>";

session_start();
$_SESSION["puntos"] = 0;
$_SESSION["contador"] = 0;
$_SESSION["pelotas"] = 1;
if(!isset($_SESSION["matriz"])){
    header("location: index.php");
}else {
    $matriz = $_SESSION["matriz"];

    if (isset($_POST) && count($_POST) >= 1) {
        $position_i = explode("-",$_POST['bubble'])[1];
        $position_j = explode("-",$_POST['bubble'])[2];

        $color = (int) explode("-",$_POST['bubble'])[0];


        function comprobarArriba($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i-1][$pos_j]) && $matriz[$pos_i-1][$pos_j] == $color) {
                $matriz[$pos_i-1][$pos_j] = 0;
                $_SESSION['matriz'] = $matriz;
                $_SESSION["pelotas"]++;
                comprobarArriba($pos_i-1, $pos_j, $matriz, $color);
            } else {
                $_SESSION["puntos"] += ($_SESSION["pelotas"] * ($_SESSION["pelotas"]-1));
            }
        }

        function comprobarAbajo($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i+1][$pos_j]) && $matriz[$pos_i+1][$pos_j] == $color) {
                $matriz[$pos_i+1][$pos_j] = 0;
                $_SESSION['matriz'] = $matriz;
                comprobarAbajo($pos_i+1, $pos_j, $matriz, $color);
            } else {
                $_SESSION["puntos"] += ($_SESSION["pelotas"] * ($_SESSION["pelotas"]-1));
            }
        }

        function comprobarDerecha($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i][$pos_j+1]) && $matriz[$pos_i][$pos_j+1] == $color) {
                $matriz[$pos_i][$pos_j+1] = 0;
                $_SESSION['matriz'] = $matriz;
                comprobarDerecha($pos_i, $pos_j+1, $matriz, $color);
            } else {
                $_SESSION["puntos"] += ($_SESSION["pelotas"] * ($_SESSION["pelotas"]-1));
            }
        }

        function comprobarIzquierda($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i][$pos_j-1]) && $matriz[$pos_i][$pos_j-1] == $color) {
                $matriz[$pos_i][$pos_j-1] = 0;
                $_SESSION['matriz'] = $matriz;
                comprobarIzquierda($pos_i, $pos_j-1, $matriz, $color);
            } else {
                $_SESSION["puntos"] += ($_SESSION["pelotas"] * ($_SESSION["pelotas"]-1));
            }
        }

        comprobarArriba($position_i,$position_j,$matriz,$color);
        comprobarAbajo($position_i,$position_j,$matriz,$color);
        comprobarDerecha($position_i,$position_j,$matriz,$color);
        comprobarIzquierda($position_i,$position_j,$matriz,$color);
        $matriz[$position_i][$position_j] = 0;

        $matriz = $_SESSION['matriz'];
        $_SESSION["pelotas"] = 0 ;

        for ( $i = 0; $i < 10 ; $i++ ) {
            for ($j = 0; $j < 10; $j++) {
                echo $matriz[$i][$j]. ' ';
            }
            echo '<br>';
        }

    }
}

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div>
    <div>
        <h1>Bubble Breaker</h1>
        <span><?= $_SESSION["puntos"] ?></span>
    </div>
    <div>
        <form id="tablero" action="nuevo_juego.php" method="post">
            <?php
                for ( $i = 0; $i < 10 ; $i++ ) {
                    for ($j = 0; $j < 10 ; $j ++) {
                        if ( $matriz[$i][$j] === 1 ) {
                            $class = "bubble_1";
                        } else if ($matriz[$i][$j] === 2) {
                            $class = "bubble_2";
                        } else if ($matriz[$i][$j] === 3) {
                            $class = "bubble_3";
                        } else if ($matriz[$i][$j] === 4) {
                            $class = "bubble_4";
                        } else if ($matriz[$i][$j] === 5) {
                            $class = "bubble_5";
                        } else if ($matriz[$i][$j] === 6) {
                            $class = "bubble_6";
                        } else if ( $matriz[$i][$j] === 0) {
                            $class = "bubble_0";
                        }
                        $value = $matriz[$i][$j];
                        echo "<button type='submit' name='bubble' class='button $class' value='$value-$i-$j'></button>";
                    }
                    echo '<br>';
                }
            ?>
        </form>
    </div>
</div>

<style>
    #tablero {
        background: gray;
        /*display: table;*/
        /*transform: rotate(-90deg);*/
    }
    .bubble_0, .bubble_1, .bubble_2, .bubble_3, .bubble_4, .bubble_5, .bubble_6 {
        width: 30px;
        height: 30px;
        border-radius: 20px;
        border: 1px solid;
        margin: 2px;
    }
    .bubble_1 {
        background: red;
    }
    .bubble_2 {
        background: cyan;
    }

    .bubble_0 {
        background: black;
    }
    .bubble_3{
        background: green;
    }

    .bubble_4 {
        background: purple;

    }

    .bubble_5 {
        background: brown;
    }

    .bubble_6 {
        background: darkorange;
    }

    .button:hover {
        box-shadow: 0px 0px 14px -2px rgba(255,254,254,1) inset;
        -webkit-box-shadow: 0px 0px 14px -2px rgba(255,254,254,1) inset;
        -moz-box-shadow: 0px 0px 14px -2px rgba(255,254,254,1) inset;
    }
</style>

<script>
    $( "#tablero" ).bind( "click", function( e ) {
        console.log(e)

    });
</script>
