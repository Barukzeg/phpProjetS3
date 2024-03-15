<?php
    class BDD {
        private static ?BDD $instance = null;    //singleton
        private PDO $connection;                 //connection a la bd

        ///Connexion au serveur MySQL
        private $server = "mysql-cabinetmedical-herbaut-lamarti.alwaysdata.net";
        private $db = "cabinetmedical-herbaut-lamarti_test";
        private $login = "344072";
        private $mdp = "7201titouan";

        // Constructeur singleton
        private function __construct() {
            try {
                $this -> connection = new PDO("mysql:host=$this->server;dbname=$this->db", $this->login, $this->mdp);
            }
            catch (Exception $e) {
                header('Location: ../erreur.php');
                exit();
            };
        }

        public static function getBDD() {
            if (!isset(self::$instance)) {
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
            public function __wakeup() {}
    }
?>
