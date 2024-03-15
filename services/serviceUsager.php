<?php

    include_once "../repository/repoUsager.php";

    class ServiceUsager {

        private static ?ServiceUsager $instance = null;    //singleton

        // Constructeur
        private function __construct() {}

        public static function getService() {
            if (self::$instance === null) {
                self::$instance = new ServiceUsager();
            }
            return self::$instance;
        }

        //Fonctions
        private static function triU($user1, $user2){
            $sorted = strcmp($user1->getNom(), $user2->getNom());
            if ($sorted == 0){
                $sorted = strcmp($user1->getPrenom(), $user2->getPrenom());
            }
            return $sorted;
        }
        
        //fonction qui retourne tout les usagers, triés par ordre alphabétique
        public static function getUsagerAlpha() {

            //récupération des usagers
            $listUsagers = RepoUsager::getRepo()->getAll();

            //tri des usagers
            usort($listUsagers, array('ServiceUsager', 'triU'));

            return $listUsagers;
        }

        public static function get($id) {
            return RepoUsager::getRepo()->getById($id);
        }

        public static function add($nom, $prenom, $civilite, $dateNaissance, $idReferent, $adresseComplete, $codePostal, $lieuNaissance, $NumSecuriteSociale) {
            $usager = new Usager(0, $nom, $prenom, $civilite, $dateNaissance, $idReferent, $adresseComplete, $codePostal, $lieuNaissance, $NumSecuriteSociale);
            return RepoUsager::getRepo()->addUsager($usager);
        }

        public static function update($id, $nom, $prenom, $civilite, $dateNaissance, $idReferent, $adresseComplete, $codePostal, $lieuNaissance, $NumSecuriteSociale) {
            $usager = new Usager($id, $nom, $prenom, $civilite, $dateNaissance, $idReferent, $adresseComplete, $codePostal, $lieuNaissance, $NumSecuriteSociale);
            return RepoUsager::getRepo()->updateUsager($usager);
        }

        public static function delete($id) {
            $usager = RepoUsager::getRepo()->getById($id);
            return RepoUsager::getRepo()->remUsager($usager);
        }
    }
?>