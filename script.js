 // Fonction pour ajuster la hauteur de la colonne de gauche en fonction de la hauteur de la colonne de droite
 function adjustLeftColumnHeight() {
    var leftColumn = $('.left-column');
    var rightColumn = $('.right-column');
    var windowHeight = $(window).height();
    var rightColumnHeight = rightColumn.outerHeight(true);

    // la colonne de gauche a une hauteur minimale égale à la hauteur de la colonne de droite
    leftColumn.css('min-height', rightColumnHeight + 'px');

    // Si la hauteur de la fenêtre est inférieure à la hauteur de la colonne de droite,
    // ajustez la hauteur de la colonne de gauche pour qu'elle corresponde à la hauteur de la fenêtre
    if (windowHeight < rightColumnHeight) {
        leftColumn.css('height', windowHeight + 'px');
    }
}

// fonction pour ajuster la hauteur de la colonne de gauche lors du chargement de la page
$(document).ready(function() {
    adjustLeftColumnHeight();
});

//fonction pour ajuster la hauteur de la colonne de gauche lors du redimensionnement de la fenêtre
$(window).resize(function() {
    adjustLeftColumnHeight();
});