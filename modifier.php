<?php
require_once 'Database.php';
require_once 'Produit.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produit = new Produit();
    $produitInfo = $produit->getProduitById($id);

    if (!$produitInfo) {
        echo "Produit non trouvé!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];

        $produit->modifier($id, $nom, $prix, $stock);

        header("Location: index.php");
        exit;
    }
} else {
    echo "ID du produit manquant!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier le Produit</title>
</head>
<body>
<h1>Modifier le Produit</h1>
<form action="modifier.php?id=<?= $id ?>" method="post">
    <input type="text" name="nom" value="<?= htmlspecialchars($produitInfo['nom']) ?>" placeholder="Nom" required>
    <input type="number" name="prix" value="<?= htmlspecialchars($produitInfo['prix']) ?>" placeholder="Prix" step="0.01" required>
    <input type="number" name="stock" value="<?= htmlspecialchars($produitInfo['stock']) ?>" placeholder="Stock" step="1" required>
    <button type="submit">Modifier</button>
</form>

<a href="index.php">Retour à la liste des produits</a>
</body>
</html>
