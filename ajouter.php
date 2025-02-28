<?php
require 'Database.php';
require 'Produit.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    $errors = [];

    // Validation du nom
    if (empty($nom)) {
        $errors[] = "Le nom du produit ne peut pas être vide.";
    }

    // Validation du prix
    if (!is_numeric($prix) || $prix <= 0) {
        $errors[] = "Le prix doit être un nombre valide supérieur à zéro.";
    }

    // Validation du stock
    if (!is_numeric($stock) || $stock < 0) {
        $errors[] = "Le stock doit être un entier positif ou zéro.";
    }

    if (count($errors) > 0) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    } else {
        $produit = new Produit();

        if ($produit->ajouter($nom, $prix, $stock)) {
            header("Location: index.php?message=Produit ajouté avec succès");
            exit;
        } else {
            echo "Erreur lors de l'ajout du produit.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter un Produit</title>
</head>
<body>
<h1>Ajouter un Produit</h1>
<form action="ajouter.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" placeholder="Nom du produit" required>
    <br><br>

    <label for="prix">Prix :</label>
    <input type="number" id="prix" name="prix" placeholder="Prix" step="0.01" required>
    <br><br>

    <label for="stock">Stock :</label>
    <input type="number" id="stock" name="stock" placeholder="Quantité en stock" required>
    <br><br>

    <button type="submit">Ajouter le Produit</button>
</form>

<a href="index.php">Retour à la liste des produits</a>
</body>
</html>
