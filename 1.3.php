<?php

function double_boucle($n) {
    for ($i = 1; $i <= $n; $i++) {
        echo str_repeat($i, $i) . "<br>";
    }
}
echo "<h2> Double boucle</h2>";
double_boucle(5);