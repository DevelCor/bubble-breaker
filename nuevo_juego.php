<?php
//echo "<td><button type='submit' name='bubble'/> <img src='assets/".$mat[$i][$j].".png'> </button></td>";

session_start();
if(!isset($_SESSION["matriz"])){
    header("location: index.php");
}else {
    $matriz = $_SESSION["matriz"];

    if (isset($_POST) && count($_POST) >= 1) {
        $position_i = explode("-",$_POST['bubble'])[1];
        $position_j = explode("-",$_POST['bubble'])[2];

        $color = (int) explode("-",$_POST['bubble'])[0];


        function actual($pos_i, $pos_j,$matriz,$color) {
//            echo '<pre>'; var_dump($matriz[$pos_i-1][$pos_j]); var_dump($color) ; echo '</pre>';
            echo '<pre>'; var_dump($matriz[$pos_i][$pos_j]); var_dump($color) ; echo '</pre>';
            if ($matriz[$pos_i-1][$pos_j] == $color) {
                echo '<pre>'; var_dump($color); var_dump($matriz[$pos_j][$pos_j]) ; echo '</pre>';
                unset($matriz[$pos_i][$pos_j]);
                $_SESSION['matriz'] = $matriz;
                actual($pos_i-1,$pos_j,$matriz,$color);
            } else {
                echo 'ya no mas';
            }
        }

        actual($position_j,$position_j,$matriz,$color);

    }
}

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div>
    <div>
        <h1>Bubble Breaker</h1>
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
    }
    .bubble_1, .bubble_2, .bubble_3, .bubble_4, .bubble_5, .bubble_6 {
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
