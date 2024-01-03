<?php

    include_once '../../modele/medecin.php';
    include_once '../../modele/usager.php';
    include_once '../../modele/rendezVous.php';
    include_once '../../repository/repoRendezVous.php';

    class ServiceRendezVous {

        private static ?ServiceRendezVous $instance = null;    //singleton

        // Constructeur
        private function __construct() {}

        public static function getService() {
            if (self::$instance === null) {
                self::$instance = new ServiceRendezVous();
            }
            return self::$instance;
        }

        public function get(int $idM, int $idC, DateTime $dateEtHeure) {
            return RepoRendezVous::getRepo()->getById($idM, $idC, $dateEtHeure);
        }

        public function add(int $idM, int $idC, DateTime $dateEtHeure, int $dureeMinutes) {
            $rendezVous = new RendezVous($idM, $idC, $dateEtHeure, $dureeMinutes);
            return RepoRendezVous::getRepo()->addRendezVous($rendezVous);
        }

        public function update(int $idM, int $idC, DateTime $dateEtHeure, int $NidM, int $NidC, DateTime $NdateEtHeure, int $dureeMinutes) {
            $rendezVous = RepoRendezVous::getRepo()->getById($idM, $idC, $dateEtHeure);
            return RepoRendezVous::getRepo()->remRendezVous($rendezVous);
            $NrendezVous = new RendezVous($NidM, $NidC, $NdateEtHeure, $dureeMinutes);
            return RepoRendezVous::getRepo()->addRendezVous($NrendezVous);
        }

        public function delete(int $idM, int $idC, DateTime $dateEtHeure) {
            $rendezVous = RepoRendezVous::getRepo()->getById($idM, $idC, $dateEtHeure);
            return RepoRendezVous::getRepo()->remRendezVous($rendezVous);
        }

        public function getAllOfM(int $idM) {
            return RepoRendezVous::getRepo()->getByMedecin($idM);
        }

        public function getAllOfC(int $idC) {
            return RepoRendezVous::getRepo()->getByClient($idC);
        }

        public function getRDVChronological() {
            $rdvs = RepoRendezVous::getRepo()->getAll();

            if ($rdvs != null) {
                function tri($rdv1, $rdv2) {
                    $result = strcmp($date1->format('Y-m-d'), $date2->format('Y-m-d'));
                    if ($result == 0) {
                        $result = strcmp($date1->format('H:i'), $date2->format('H:i'));
                    }
                    return $result;
                }
    
                usort($rdvs, "tri");
            }

            return $rdvs;
        }
    }
?>