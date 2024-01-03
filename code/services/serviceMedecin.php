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

        //fonction qui retourne tout les medecins, triés par ordre alphabétique
        public function getMedecinAlpha() {

            //récupération des usagers
            $listMedecin = RepoMedecin::getRepo()->getAll();

            function triM($med1, $med2){
                $sorted = strcmp($med1->getNom(), $med2->getNom());
                if ($sorted == 0){
                    $sorted = strcmp($med1->getPrenom(), $med2->getPrenom());
                }
                return $sorted;
            }

            //tri des usagers
            usort($listMedecin, "triM");

            return $listMedecin;
        }

        public function get($id) {
            return RepoMedecin::getRepo()->getById($id);
        }

        public function add($nom, $prenom, $civilite) {
            $medecin = new Medecin(0, $nom, $prenom, $civilite);
            return RepoMedecin::getRepo()->addMedecin($medecin);
        }

        public function update($id, $nom, $prenom, $civilite) {
            $medecin = new Medecin($id, $nom, $prenom, $civilite);
            return RepoMedecin::getRepo()->updateMedecin($medecin);
        }

        public function delete($id) {
            $medecin = RepoMedecin::getRepo()->getById($id);
            return RepoMedecin::getRepo()->remMedecin($medecin);
        }
    }
?>