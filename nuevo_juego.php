<?php
//echo "<td><button type='submit' name='bubble'/> <img src='assets/".$mat[$i][$j].".png'> </button></td>";

session_start();
if(!isset($_SESSION["puntos"])) {
    $_SESSION["puntos"] = 0;
}
$_SESSION["contador"] = 0;
$_SESSION["pelotasArri"] = 1;
$_SESSION["pelotasAba"] = 1;
$_SESSION["pelotasDere"] = 1;
$_SESSION["pelotasIz"] = 1;
$_SESSION['actual'] = false;


$_SESSION["fin_iz"] = false;
$_SESSION["fin_aba"] = false;
$_SESSION["fin_arri"] = false;
$_SESSION["fin_dere"] = false;


if(!isset($_SESSION["matriz"])){
    header("location: index.php");
}else {
    $matriz = $_SESSION["matriz"];

    if (isset($_POST['bubble'])) {
        $position_i = explode("-",$_POST['bubble'])[1];
        $position_j = explode("-",$_POST['bubble'])[2];

        $color = (int) explode("-",$_POST['bubble'])[0];


        function comprobarArriba($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i-1][$pos_j]) && $matriz[$pos_i-1][$pos_j] == $color) {
                $matriz[$pos_i-1][$pos_j] = 0;
                $_SESSION['matriz'] = $matriz;
                $_SESSION["pelotasArri"]++;
                $_SESSION['actual'] = true;
                comprobarArriba($pos_i-1, $pos_j, $matriz, $color);
            } else {
                $_SESSION["puntos"] += ((int)$_SESSION["pelotasArri"] * ((int)$_SESSION["pelotasArri"]-1));
                $_SESSION["pelotasArri"] = 0 ;
            }
        }

        function comprobarAbajo($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i+1][$pos_j]) && $matriz[$pos_i+1][$pos_j] == $color) {
                $matriz[$pos_i+1][$pos_j] = 0;
                $_SESSION['matriz'] = $matriz;
                $_SESSION["pelotasAba"]++;
                $_SESSION['actual'] = true;
                comprobarAbajo($pos_i+1, $pos_j, $matriz, $color);
            } else {
                $_SESSION["puntos"] += ((int)$_SESSION["pelotasAba"] * ((int)$_SESSION["pelotasAba"]-1));
                $_SESSION["pelotasAba"] = 0 ;
            }
        }

        function comprobarDerecha($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i][$pos_j+1]) && $matriz[$pos_i][$pos_j+1] == $color) {
                $matriz[$pos_i][$pos_j+1] = 0;
                $_SESSION['matriz'] = $matriz;
                $_SESSION["pelotasDere"]++;
                $_SESSION['actual'] = true;
                comprobarDerecha($pos_i, $pos_j+1, $matriz, $color);
            } else {
                $_SESSION["puntos"] += ((int)$_SESSION["pelotasDere"] * ((int)$_SESSION["pelotasDere"]-1));
                $_SESSION["pelotasDere"] = 0 ;
            }
        }

        function comprobarIzquierda($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i][$pos_j-1]) && $matriz[$pos_i][$pos_j-1] == $color) {
                $matriz[$pos_i][$pos_j-1] = 0;
                $_SESSION['matriz'] = $matriz;
                $_SESSION["pelotasIz"]++;
                $_SESSION['actual'] = true;
                comprobarIzquierda($pos_i, $pos_j-1, $matriz, $color);
            } else {
                $_SESSION["puntos"] += ((int)$_SESSION["pelotasIz"] * ((int)$_SESSION["pelotasIz"]-1));
                $_SESSION["pelotasIz"] = 0 ;
            }
        }


        function finComprobarArriba($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i-1][$pos_j]) && $matriz[$pos_i-1][$pos_j] == $color) {
                finComprobarArriba($pos_i-1, $pos_j, $matriz, $color);
            } else {
                $_SESSION["fin_arri"] = true ;
            }
        }

        function finComprobarAbajo($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i+1][$pos_j]) && $matriz[$pos_i+1][$pos_j] == $color) {
                finComprobarAbajo($pos_i+1, $pos_j, $matriz, $color);
            } else {
                $_SESSION["fin_aba"] = true ;
            }
        }

        function finComprobarDerecha($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i][$pos_j+1]) && $matriz[$pos_i][$pos_j+1] == $color) {
                finComprobarDerecha($pos_i, $pos_j+1, $matriz, $color);
            } else {
                $_SESSION["fin_dere"] = true ;
            }
        }

        function finComprobarIzquierda($pos_i, $pos_j, $matriz, $color) {
            if ( isset($matriz[$pos_i][$pos_j-1]) && $matriz[$pos_i][$pos_j-1] == $color) {
                finComprobarIzquierda($pos_i, $pos_j-1, $matriz, $color);
            } else {
                $_SESSION["fin_iz"] = true ;
            }
        }
        comprobarArriba($position_i,$position_j,$matriz,$color);
        comprobarAbajo($position_i,$position_j,$matriz,$color);
        comprobarDerecha($position_i,$position_j,$matriz,$color);
        comprobarIzquierda($position_i,$position_j,$matriz,$color);




        if ( $_SESSION['actual'] == true ) {
            $_SESSION['matriz'][$position_i][$position_j] = 0;
        } else {
            $_SESSION['actual'] == false;
        }

        $matriz = $_SESSION['matriz'];

        finComprobarAbajo($position_i,$position_j,$matriz,$color);
        finComprobarArriba($position_i,$position_j,$matriz,$color);
        finComprobarDerecha($position_i,$position_j,$matriz,$color);
        finComprobarIzquierda($position_i,$position_j,$matriz,$color);

        if (($_SESSION["fin_iz"] == true) && ($_SESSION["fin_dere"] == true ) && ($_SESSION["fin_aba"] == true) && ($_SESSION["fin_arri"] == true) ) {
            $puntos = $_SESSION["puntos"];
            $text = "Fin del juego, no mas movimientos posibles: su puntaje fue: $puntos";
            echo "<script> alert('".$text."'); </script>";
        }

    }
}

?>
<div>
    <div>
        <h1>Bubble Breaker</h1>
        <span> Puntos: <?= $_SESSION["puntos"] ?></span>
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
        display: table;
        transform: rotate(-90deg);
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
        display: none;
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
