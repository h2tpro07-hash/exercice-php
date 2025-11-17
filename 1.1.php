<?php


function school($age) {
    if ($age < 3) {
        return "creche";
    } elseif ($age < 6) {
        return "maternelle";
    } elseif ($age < 11) {
        return "primaire";
    } elseif ($age < 16) {
        return "college";
    } elseif ($age < 18) {
        return "lycee";
    } else {
        return "";
    }
}    
echo "<h2>School</h2>";
echo "2 ans : " . school(2) . "<br>";
echo "5 ans : " . school(5) . "<br>";
echo "14 ans : " . school(14) . "<br>";