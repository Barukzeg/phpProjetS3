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

        public static function get(int $idM, int $idC, DateTime $dateEtHeure) {
            return RepoRendezVous::getRepo()->getById($idM, $idC, $dateEtHeure);
        }

        public static function add(int $idM, int $idC, DateTime $dateEtHeure, int $dureeMinutes) {
            $rendezVous = new RendezVous($idM, $idC, $dateEtHeure, $dureeMinutes);
            return RepoRendezVous::getRepo()->addRendezVous($rendezVous);
        }

        public static function update(int $idM, int $idC, DateTime $dateEtHeure, DateTime $NdateEtHeure, int $dureeMinutes) {
            $rendezVous = RepoRendezVous::getRepo()->getById($idM, $idC, $dateEtHeure);
            return RepoRendezVous::getRepo()->updateRendezVous($rendezVous, $NdateEtHeure, $dureeMinutes);
        }

        public static function delete(int $idM, int $idC, DateTime $dateEtHeure) {
            $rendezVous = RepoRendezVous::getRepo()->getById($idM, $idC, $dateEtHeure);
            return RepoRendezVous::getRepo()->remRendezVous($rendezVous);
        }

        public static function getAllOfM(int $idM) {
            return RepoRendezVous::getRepo()->getByMedecin($idM);
        }

        public static function getAllOfC(int $idC) {
            return RepoRendezVous::getRepo()->getByClient($idC);
        }

        private static function getAllFuture() {
            
            $rdvs = RepoRendezVous::getRepo()->getAll();

            $results = array();
            foreach ($rdvs as $rdv) {
                if ($rdv->getDateEtHeure() > new DateTime()) {
                    $results[] = $rdv;
                }
            }

            return $results;
        }

        public static function getRDVChronological(boolean $future) {

            if ($future) {
                $rdvs = self::getAllFuture();
            } else {
                $rdvs = RepoRendezVous::getRepo()->getAll();
            }

            if ($rdvs != null) {
                function tri($rdv1, $rdv2) {
                    $date1 = $rdv1->getDateEtHeure();
                    $date2 = $rdv2->getDateEtHeure();
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

        public static function getRDVNonChronological(boolean $future) {

            if ($future) {
                $rdvs = self::getAllFuture();
            } else {
                $rdvs = RepoRendezVous::getRepo()->getAll();
            }

            if ($rdvs != null) {
                function tri($rdv2, $rdv1) {
                    $date1 = $rdv1->getDateEtHeure();
                    $date2 = $rdv2->getDateEtHeure();
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