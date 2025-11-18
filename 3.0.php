<?php

$fichier = 'contact.txt';


$nouveauxContacts = ["Alice Dupont", "John Doe", "Jean Martin"];


if (!file_exists($fichier)) {
    die("Erreur : Le fichier $fichier n'existe pas. Veuillez le télécharger d'abord.\n");
}


$contenu = file_get_contents($fichier);


$contactsExistants = array_filter(array_map('trim', explode("\n", $contenu)));


echo "TEST : \n";
foreach ($contactsExistants as $contact) {
    if (!empty($contact)) {
        echo "- $contact\n";
    }
}
echo "\n";


$contactsAjoutes = [];

foreach ($nouveauxContacts as $nouveauContact) {
   
    $existe = false;
    foreach ($contactsExistants as $contactExistant) {
        if (strcasecmp(trim($contactExistant), trim($nouveauContact)) === 0) {
            $existe = true;
            break;
        }
    }
    
    if (!$existe) {
        $contactsAjoutes[] = $nouveauContact;
    } else {
        echo "  '$nouveauContact' existe déjà dans le fichier.\n";
    }
}


if (!empty($contactsAjoutes)) {
    echo "\n=== Ajout de nouveaux contacts ===\n";
    
    
    $handle = fopen($fichier, 'a');
    
    foreach ($contactsAjoutes as $contact) {
        
        if (!empty($contenu) && substr($contenu, -1) !== "\n") {
            fwrite($handle, "\n");
            $contenu .= "\n"; 
        }
        
        fwrite($handle, $contact . "\n");
        echo " '$contact' a été ajouté\n";
    }
    
    fclose($handle);
    
    echo "\n" . count($contactsAjoutes) . " contact(s) ajouté(s) avec succès.\n";
} else {
    echo "\n Aucun nouveau contact à ajouter.\n";
}


echo "\nTEST : \n";
$contenuFinal = file_get_contents($fichier);
echo $contenuFinal;
?>