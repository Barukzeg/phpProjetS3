<?php

    include_once '../../modele/medecin.php';
    include_once '../../repository/repoMedecin.php';

    class ServiceMedecin {

        private static ?ServiceMedecin $instance = null;    //singleton

        // Constructeur
        private function __construct() {}

        public static function getService() {
            if (self::$instance === null) {
                self::$instance = new ServiceMedecin();
            }
            return self::$instance;
        }

        private static function triM($med1, $med2){
            $sorted = strcmp($med1->getNom(), $med2->getNom());
            if ($sorted == 0){
                $sorted = strcmp($med1->getPrenom(), $med2->getPrenom());
            }
            return $sorted;
        }

        //fonction qui retourne tous les medecins, triés par ordre alphabétique
        public static function getMedecinAlpha() {

            //récupération des usagers
            $listMedecin = RepoMedecin::getRepo()->getAll();

            //tri des usagers
            usort($listMedecin, array('ServiceMedecin', 'triM'));

            return $listMedecin;
        }

        public static function get($id) {
            return RepoMedecin::getRepo()->getById($id);
        }

        public static function add($nom, $prenom, $civilite) {
            $medecin = new Medecin(0, $nom, $prenom, $civilite);
            return RepoMedecin::getRepo()->addMedecin($medecin);
        }

        public static function update($id, $nom, $prenom, $civilite) {
            $medecin = new Medecin($id, $nom, $prenom, $civilite);
            return RepoMedecin::getRepo()->updateMedecin($medecin);
        }

        public static function delete($id) {
            $medecin = RepoMedecin::getRepo()->getById($id);
            return RepoMedecin::getRepo()->remMedecin($medecin);
        }
    }
?>