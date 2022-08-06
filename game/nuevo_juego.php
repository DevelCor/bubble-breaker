<?php
$width = 10;
$height = 10;

for ( $i = 0; $i < $width ; $i++ ) {
    for ($j = 0; $j < $height ; $j ++) {
        $matriz[$i][$j] = rand(1, 6);
    }
}
?>

<div>
    <div>
        <h1>Nuevo juego</h1>
    </div>
    <div>
        <form>
            <?php
                for ( $i = 0; $i < $width ; $i++ ) {
                    for ($j = 0; $j < $height ; $j ++) {
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
                        echo "<button type='button' class='$class'></button>";
                    }
                    echo '<br>';
                }
            ?>
        </form>
    </div>
</div>

<style>
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
</style>

<script>

</script>
