<?php
require_once 'Database.php';

class Produit {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function ajouter(string $nom, float $prix, int $stock) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO produits (nom, prix, stock) VALUES (:nom, :prix, :stock)");
            return $stmt->execute([':nom' => $nom, ':prix' => $prix, ':stock' => $stock]);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout du produit: " . $e->getMessage());
            return false;
        }
    }

    public function supprimer($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM produits WHERE id = :id");
            return $stmt->execute(['id' => (int)$id]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la suppression du produit: " . $e->getMessage());
            return false;
        }
    }

    public function modifier($id, $nom, $prix, $stock) {
            $stmt = $this->pdo->prepare("UPDATE produits SET nom = :nom, prix = :prix, stock = :stock WHERE id = :id");
            return $stmt->execute([
                'id' => (int)$id,
                'nom' => htmlspecialchars(strip_tags($nom)),
                'prix' => (float)$prix,
                'stock' => (int)$stock,
            ]);
    }

    public function lister() {
            $stmt = $this->pdo->query("SELECT * FROM produits");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduitById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM produits WHERE id = :id");
            $stmt->execute(['id' => (int)$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne le produit sous forme de tableau associatif
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération du produit: " . $e->getMessage());
            return false;
        }
    }


    /** Ajout d'un nouveau produit dans la bdd
     *@param string $nom Le nom du produit
     *@param float $prix Le Prix
     *@param int $stock La quantité
     *@return boolean true si ajout OK sinon false
     */
}