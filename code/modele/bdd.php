<?php
    class BDD {
        private static $instance = null;
        private $connection;

        // Informations de connexion à la base de données
        private $host = 'localhost';
        private $dbname = 'ma_base_de_donnees';
        private $username = 'utilisateur';
        private $password = 'mot_de_passe';

        // Constructeur privé pour empêcher l'instanciation directe
        private function __construct() {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // Autres paramètres de connexion et configurations si nécessaire
        }

        // Méthode pour obtenir l'instance unique de la classe
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new BDD();
            }
            return self::$instance;
        }

        // Méthode pour récupérer la connexion à la base de données
        public function getConnection() {
            return $this->connection;
        }

        // Empêcher la duplication de l'instance via le clonage
        private function __clone() {}

        // Empêcher la désérialisation de l'instance
        private function __wakeup() {}
    }

    // Exemple d'utilisation
    $bdd = BDD::getInstance();
    $connexion = $bdd->getConnection();
?>
