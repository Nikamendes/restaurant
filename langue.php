<?php
function loadlangage($langage) {
    if ($langage === 'fr') {
        $welcome_message = "Bienvenue sur notre site!";
        $about_message = "À propos de nous : Nous sommes une entreprise spécialisée...";
       

        // Affichage des textes en français
        echo "<h1>$welcome_message</h1>";
        echo "<p>$about_message</p>";
        
    } else {
        // Si la langue n'est pas spécifiée ou n'est pas prise en charge
        echo "Langue non prise en charge.";
    }
}

// fonction pour charger le texte en français
loadlangage("fr");
?>