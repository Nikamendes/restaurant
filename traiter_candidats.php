<?php
require_once './back/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accepte']) || isset($_POST['refuse'])) {
        $conn->beginTransaction(); // Commencer une transaction pour assurer l'intégrité de la base de données

        // Mettre à jour le statut des candidats acceptés
        if (isset($_POST['accepte'])) {
            foreach ($_POST['accepte'] as $id_candidat => $valeur) {
                $sqlAccepte = "UPDATE restaurant_candidats SET statut = 'Accepté' WHERE ID_candidat = :id_candidat";
                $stmtAccepte = $conn->prepare($sqlAccepte);
                $stmtAccepte->bindParam(':id_candidat', $id_candidat, PDO::PARAM_INT);
                $stmtAccepte->execute();
            }
        }

        // Mettre à jour le statut des candidats refusés
        if (isset($_POST['refuse'])) {
            foreach ($_POST['refuse'] as $id_candidat => $valeur) {
                $sqlRefuse = "UPDATE restaurant_candidats SET statut = 'Refusé' WHERE ID_candidat = :id_candidat";
                $stmtRefuse = $conn->prepare($sqlRefuse);
                $stmtRefuse->bindParam(':id_candidat', $id_candidat, PDO::PARAM_INT);
                $stmtRefuse->execute();
            }
        }

        $conn->commit(); // Valider la transaction

        // Rediriger vers la page "page_recruteur.php" après le traitement
        header('Location: page_recruteur.php');
        exit();
    }
}