<?php
    class BDD {
        private static $instance = null;    //singleton
        private $connection;                //connection a la bd

        ///Connexion au serveur MySQL
        private $server = "localhost";
        private $db = "cabinet_medical";
        private $login = "root";
        private $mdp = "";

        // Constructeur singleton
        private function __construct() {
            try {
                $this -> connection = new PDO("mysql:host=$this->server;dbname=$this->db", $this->login, $this->mdp);
            }
            catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            };
        }

        public static function getBDD() {
            if (self::$instance === null) {
                self::$instance = new BDD();
            }
            return self::$instance;
        }

        // connexion
        public function getConnection() {
            return $this->connection;
        }

        //Fonctions de sécurité

            // Sécurité contre la duplication
            private function __clone() {}
            // Sécurité contre la désérialisation
            private function __wakeup() {}
    }
?>
