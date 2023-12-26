<?php

    include '../modele/medecin.php';
    include '../repository/repoMedecin.php';
    include '../repository/repoRendezVous.php';

    class ServiceMedecin {

        private static ?ServiceMedecin $instance = null;    //singleton

        // Constructeur
        private function __construct() {}

        public static function getService() {
            if (self::$instance === null) {
                self::$instance = new ServiceUsager();
            }
            return self::$instance;
        }

        //nombre d'heures de travail d'un medecin
        public function getTotalHeures($id) {

            $listeRDV = RepoRendezVous::getRepo()->getByMedecin($id);
            $total = 0;

            foreach ($listeRDV as $rdv) {
                $total += $rdv->getDureeMinutes();
            }

            return $total/60;
        }

        //fonction qui retourne tout les medecins, triés par ordre alphabétique
        public function getMedecinAlpha() {

            //récupération des usagers
            $listMedecin = RepoMedecin::getRepo()->getAll();

            function tri($med1, $med2){
                $sorted = strcmp($med1->getNom(), $med2->getNom());
                if ($sorted == 0){
                    $sorted = strcmp($med1->getPrenom(), $med2->getPrenom());
                }
                return $sorted;
            }

            //tri des usagers
            usort($listMedecin, "tri");

            return $listMedecin;
        }
    }
?>