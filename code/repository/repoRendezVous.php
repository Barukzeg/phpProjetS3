<?php
    include '../modele/rendezVous.php';
    include '../bd/bdd.php'

    class RepoRendezVous {

        private static RepoRendezVous $instance = null;    //singleton
        private BDD $db;

        // Constructeur
        private function __construct() {
            $this->db = BDD::getBDD()->getConnection();
        }

        private function getBD() {
            return $this->db;
        }

        public static function getRepo() {
            if (self::$instance === null) {
                self::$instance = new RepoRendezVous();
            }
            return self::$instance;
        }

        // Fonctions

        // get un rendezVous par ses id et date
        public static function getById(int $idM, int $idC, date $dateEtHeure) {
            
            $sqlDateEtHeure = $dateEtHeure->format('Y-m-d H:i:s');

            // requete
            $query = $db->prepare("SELECT * FROM RendezVous WHERE idMedecin = :idM AND idClient = :idC AND dateEtHeure = :dateEtHeure");
            $query->bindParam(':idM', $idM);
            $query->bindParam(':idC', $idC);
            $query->bindParam(':dateEtHeure', $sqlDateEtHeure);

            // execution
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            // retour d'une instance de RendezVous
            if ($result) {
                return new RendezVous($result['idMedecin'], $result['idClient'], $result['dateEtHeure'], $result['dureeMinutes']);
            } else {
                return null;
            }
        }

        // get tous les rendezVous d'un medecin
        public static function getByMedecin(int $idM) {
    
            // requete
            $query = $db->prepare("SELECT * FROM RendezVous WHERE idMedecin = :idM");
            $query->bindParam(':idM', $idM);

            // execution
            $query->execute();
            $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // retour d'un tableau d'instances de RendezVous
            if ($resultats) {
                $rendezVous = array();
                foreach ($resultats as $result) {
                    $rendezVous[] = new RendezVous($result['idMedecin'], $result['idClient'], $result['dateEtHeure'], $result['dureeMinutes']);
                }
                return $rendezVous;
            } else {
                return null;
            }
        }

        // get tous les rendezVous d'un client
        public static function getByClient(int $idC) {
    
            // requete
            $query = $db->prepare("SELECT * FROM RendezVous WHERE idClient = :idC");
            $query->bindParam(':idC', $idC);

            // execution
            $query->execute();
            $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // retour d'un tableau d'instances de RendezVous
            if ($resultats) {
                $rendezVous = array();
                foreach ($resultats as $result) {
                    $rendezVous[] = new RendezVous($result['idMedecin'], $result['idClient'], $result['dateEtHeure'], $result['dureeMinutes']);
                }
                return $rendezVous;
            } else {
                return null;
            }
        }

        // ajoute un rendezVous
        public static function addRendezVous(RendezVous $rendezVous) {
    
            // requete
            $query = $db->prepare("INSERT INTO RendezVous (idMedecin, idClient, dateEtHeure, dureeMinutes) VALUES (:idM, :idC, :dateEtHeure, :dureeMinutes)");
            $query->bindParam(':idM', $rendezVous->getIdMedecin());
            $query->bindParam(':idC', $rendezVous->getIdClient());
            $query->bindParam(':dateEtHeure', $rendezVous->getDateEtHeure());
            $query->bindParam(':dureeMinutes', $rendezVous->getDureeMinutes());

            // execution
            $query->execute();
        }

        // modifie un rendezVous
        public static function updateRendezVous(RendezVous $rendezVous) {
    
            // requete
            $query = $db->prepare("UPDATE RendezVous SET dureeMinutes = :dureeMinutes WHERE idMedecin = :idM AND idClient = :idC AND dateEtHeure = :dateEtHeure");
            $query->bindParam(':idM', $rendezVous->getIdMedecin());
            $query->bindParam(':idC', $rendezVous->getIdClient());
            $query->bindParam(':dateEtHeure', $rendezVous->getDateEtHeure());
            $query->bindParam(':dureeMinutes', $rendezVous->getDureeMinutes());

            // execution
            $query->execute();
        }

        // supprime un rendezVous
        public static function remRendezVous(RendezVous $rendezVous) {
    
            // requete
            $query = $db->prepare("DELETE FROM RendezVous WHERE idMedecin = :idM AND idClient = :idC AND dateEtHeure = :dateEtHeure");
            $query->bindParam(':idM', $rendezVous->getIdMedecin());
            $query->bindParam(':idC', $rendezVous->getIdClient());
            $query->bindParam(':dateEtHeure', $rendezVous->getDateEtHeure());

            // execution
            $query->execute();
        }

        // get tous les rendezVous d'un medecin à une date
        public static function getByMedecinEtDate(int $idM, date $dateEtHeure, int $dureeMinutes) {
    
            $sqlDate = $dateEtHeure->format('Y-m-d H:i:s');
            sqlDateFin = $dateEtHeure->add(new DateInterval('PT'.$dureeMinutes.'M'))->format('Y-m-d H:i:s');

            // requete
            $query = $db->prepare("SELECT * FROM RendezVous WHERE idMedecin = :idM AND dateEtHeure = :dateEtHeure");
            $query->bindParam(':idM', $idM);
            $query->bindParam(':date', $sqlDate);

            // execution
            $query->execute();
            $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // retour d'un tableau d'instances de RendezVous
            if ($resultats) {
                $rendezVous = array();
                foreach ($resultats as $result) {
                    $rendezVous[] = new RendezVous($result['idMedecin'], $result['idClient'], $result['dateEtHeure'], $result['dureeMinutes']);
                }
                return $rendezVous;
            } else {
                return null;
            }
        }

        // get tous les rendezVous
        public static function getAll() {
    
            // requete
            $query = $db->prepare("SELECT * FROM RendezVous");

            // execution
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // retour d'un tableau d'instances de RendezVous
            if ($result) {
                $rendezVous = array();
                foreach ($result as $row) {
                    $rendezVous[] = new RendezVous($row['idMedecin'], $row['idClient'], $row['dateEtHeure'], $row['dureeMinutes']);
                }
                return $rendezVous;
            } else {
                return null;
            }
        }
    }
?>