<?php

function my_str_contains($haystack, $needle) {
    $longueurHaystack = strlen($haystack);
    $longueurNeedle = strlen($needle);
    
   
    if ($longueurNeedle == 0) {
        return true;
    }
    
   
    if ($longueurNeedle > $longueurHaystack) {
        return false;
    }
    

    for ($i = 0; $i <= $longueurHaystack - $longueurNeedle; $i++) {
        $trouve = true;
        
       
        for ($j = 0; $j < $longueurNeedle; $j++) {
            if ($haystack[$i + $j] != $needle[$j]) {
                $trouve = false;
                break;
            }
        }
        
       
        if ($trouve) {
            return true;
        }
    }
    
   
    return false;
}
echo "Tests \n";
echo "Contient 'Hello World', 'World' : " . (my_str_contains("Hello World", "World") ? "true" : "false") . "\n"; 
echo "Contient 'Hello World', 'world' : " . (my_str_contains("Hello World", "world") ? "true" : "false") . "\n"; 
echo "Contient 'PHP est super', 'est' : " . (my_str_contains("PHP est super", "est") ? "true" : "false") . "\n"; 
echo "Contient 'Bonjour', 'au revoir' : " . (my_str_contains("Bonjour", "au revoir") ? "true" : "false") . "\n";
echo "Contient 'Test', '' : " . (my_str_contains("Test", "") ? "true" : "false") . "\n"; 

?>