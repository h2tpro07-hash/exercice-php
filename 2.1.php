<?php



function calcMoy($nombres) {
   
    if (count($nombres) == 0) {
        return 0;
    }
    
    $somme = 0;
    
    for ($i = 0; $i < count($nombres); $i++) {
        $somme += $nombres[$i];
    }
    
  
    return $somme / count($nombres);
}
echo " Tests \n";
echo "Moyenne de [10, 20, 30] : " . calcMoy([10, 20, 30]) . "\n"; 
echo "Moyenne de [5, 10, 15, 20] : " . calcMoy([5, 10, 15, 20]) . "\n"; 
echo "Moyenne de [100] : " . calcMoy([100]) . "\n"; 
echo "Moyenne de [] : " . calcMoy([]) . "\n\n";

?>