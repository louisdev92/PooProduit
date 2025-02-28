<?php
/* class Database
 * Se connecter à la base de données
 * Bien gérer les ressources (pattern Singleton)
 * Simplifier l'utilisation de PDO
 */
class Database
{

    // propriété privée - instance unique de la connexion
    private static $instance  = null;

    // pour stocker l'objet $pdo
    private $pdo;

    // Constructeur privé (il ne peut être appelé qu'une fois)
    private function __construct(){

        // Configuration de la base de données
        $host = "localhost";
        $dbname = "pdobrief";
        $user = "root";
        $password = "";

        try{
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("Erreur de connexion :" . $e->getMessage());
        }
    }


    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public  function  getConnection(){
        // Retourne l'objet PDO. Pourquoi ? Pour voir faire des requêtes
        return $this->pdo;
    }
}

// Exemple pour appeler cette classe
$db = Database::getInstance()->getConnection();