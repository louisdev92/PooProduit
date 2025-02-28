<?php
require 'Database.php';
require 'Produit.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    $produit = new Produit();

    $produitInfo = $produit->getProduitById($id); // Vous avez besoin de la méthode getProduitById()

    if ($produitInfo) {
        if ($produit->supprimer($id)) {
            header("Location: index.php?message=Produit supprimé avec succès");
            exit;
        } else {
            echo "Erreur lors de la suppression du produit.";
        }
    } else {
        echo "Produit introuvable.";
    }
} else {
    echo "ID invalide.";
}
?>