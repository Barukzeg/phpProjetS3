<?php

    include '../modele/medecin.php';
    include '../repository/repoMedecin.php';

    class ServiceMedecin {

        private static $instance = null;    //singleton

        // Constructeur
        private function __construct() {}

        public static function getService() {
            if (self::$instance === null) {
                self::$instance = new ServiceMedecin();
            }
            return self::$instance;
        }

        //TODO verifs
        public function getTotalHeures($id) {

            $liste = RepoMedecin::getRepo() -> getAll();

        }
    }
?>