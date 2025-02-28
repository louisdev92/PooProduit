<?php
require 'Database.php';
require 'Produit.php';

$produit = new Produit();
$produits = $produit->lister();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestion des Produits</title>
</head>
<body>
<h1>Liste des Produits</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Stock</th>
        <th>Action</th>
    </tr>
    <?php foreach ($produits as $produit) : ?>
        <tr>
            <td><?= htmlspecialchars($produit['id']) ?></td>
            <td><?= htmlspecialchars($produit['nom']) ?></td>
            <td><?= htmlspecialchars($produit['prix']) ?></td>
            <td><?= htmlspecialchars($produit['stock']) ?></td>
            <td>
                <a href="modifier.php?id=<?= $produit['id'] ?>">Modifier</a> |
                <a href="supprimer.php?id=<?= $produit['id'] ?>" onclick="return confirm('Supprimer ce produit ?');">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Ajouter un Produit</h1>
<form action="ajouter.php" method="post">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="number" name="prix" placeholder="Prix" step="0.01" required>
    <input type="number" name="stock" placeholder="Stock" step="1" required>
    <button type="submit">Ajouter</button>
</form>
</body>
</html>
