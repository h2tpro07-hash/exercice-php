<?php

function my_strrev($str) {
    $resultat = "";
    $longueur = strlen($str);
    
    
    for ($i = $longueur - 1; $i >= 0; $i--) {
        $resultat .= $str[$i];
    }
    
    return $resultat;
}
echo "Tests \n";
echo "Inverse 'Bonjour' : " . my_strrev("Bonjour") . "\n"; 
echo "Inverse 'PHP' : " . my_strrev("PHP") . "\n"; 
echo "Inverse 'Hello World' : " . my_strrev("Hello World") . "\n"; 
echo "Inverse '' : '" . my_strrev("") . "'\n\n"; 

?>