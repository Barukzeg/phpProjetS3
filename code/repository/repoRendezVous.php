<?php
    include '../modele/rendezVous.php';
    include '../bd/bdd.php'

    class RepoRendezVous {

        private static ?RepoRendezVous $instance = null;    //singleton
        private BDD $db;

        // Constructeur
        private function __construct() {
            $this->db = BDD::getBDD()->getConnection();
        }

        private function getBD() {
            return $this->db;
        }

        public static function getRepo() {
            if (self::$instance == null) {
                self::$instance = new RepoRendezVous();
            }
            return self::$instance;
        }

        // Fonctions

        // get un rendezVous par ses id et date
        public static function getById(int $idM, int $idC, DateTime $dateEtHeure) {
            
            $sqlDateEtHeure = $dateEtHeure->format('Y-m-d H:i:s');

            // requete
            $query = self::getBD()->prepare("SELECT * 
                                                FROM RendezVous 
                                                WHERE idMedecin = :idM 
                                                AND idClient = :idC 
                                                AND dateEtHeure = :dateEtHeure");
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
            $query = self::getBD()->prepare("SELECT *
                                                FROM RendezVous 
                                                WHERE idMedecin = :idM");
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
            $query = self::getBD()->prepare("SELECT * 
                                                FROM RendezVous 
                                                WHERE idClient = :idC");
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

        // get si un medecin est occupé à une date et heure donnée
        public static function isOccupied(int $idM, DateTime $dateEtHeure, int $dureeMinutes) {

            $sqlDateEtHeure = $dateEtHeure->format('Y-m-d');

            // requete
            $query = self::getBD()->prepare("SELECT * 
                                                FROM RendezVous 
                                                WHERE idMedecin = :idM 
                                                AND day(dateEtHeure) = day(:dateEtHeure)
                                                AND month(dateEtHeure) = month(:dateEtHeure)
                                                AND year(dateEtHeure) = year(:dateEtHeure)");
            $query->bindParam(':idM', $idM);
            $query->bindParam(':dateEtHeure', $sqlDateEtHeure);

            // execution
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // retour d'un booleen pour savoir si le medecin est occupé à la date et heure donnée
            foreach ($result as $rdv) {

                //dates de debut et fin de la durée donnée
                $dateInD = $dateEtHeure;
                $dateInF = $dateInD->add(new DateInterval('PT'.$dureeMinutes.'M'));

                //dates de debut et fin d'un des rendezVous trouvés
                $dateD = new DateTime($rdv['dateEtHeure']);
                $dateF = $dateD->add(new DateInterval('PT'.$rdv['dureeMinutes'].'M'));

                //si la date de debut de la duree donnée est entre les dates de debut et fin d'un des rendezVous trouvés
                if ($dateInD >= $dateD && $dateInD <= $dateF) {
                    return true;

                //si la date de fin de la duree donnée est entre les dates de debut et fin d'un des rendezVous trouvés
                } else if ($dateInF >= $dateD && $dateInF <= $dateF) {
                    return true;

                //si la date de debut et de fin de la duree donnée est entre les dates de debut et fin d'un des rendezVous trouvés
                } else if ($dateInD <= $dateD && $dateInF >= $dateF) {
                    return true;
                }
            }
        }

        // ajoute un rendezVous
        public static function addRendezVous(RendezVous $rendezVous) {
            try {
                if (self::getById($rendezVous->getIdMedecin(), $rendezVous->getIdClient(), $rendezVous->getDateEtHeure()) == null) {
                    if (!self::isOccupied($rendezVous->getIdMedecin(), $rendezVous->getDateEtHeure(), $rendezVous->getDureeMinutes())) {
                        // requete
                        $query = self::getBD()->prepare("INSERT INTO RendezVous (idMedecin, idClient, dateEtHeure, dureeMinutes) 
                        VALUES (:idM, :idC, :dateEtHeure, :dureeMinutes)");
                        $query->bindParam(':idM', $rendezVous->getIdMedecin());
                        $query->bindParam(':idC', $rendezVous->getIdClient());
                        $query->bindParam(':dateEtHeure', $rendezVous->getDateEtHeure());
                        $query->bindParam(':dureeMinutes', $rendezVous->getDureeMinutes());

                        // execution
                        $query->execute();
                    } else {
                        throw new Exception("Medecin non disponible");
                    }
                } else {
                    throw new Exception("RendezVous déjà existant");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // modifie un rendezVous
        public static function updateRendezVous(RendezVous $rendezVous) {
    
            try {
                if (self::getById($rendezVous->getIdMedecin(), $rendezVous->getIdClient(), $rendezVous->getDateEtHeure()) != null) {
                    
                    if (!self::isOccupied($rendezVous->getIdMedecin(), $rendezVous->getDateEtHeure(), $rendezVous->getDureeMinutes())) {
                        // requete
                        $query = self::getBD()->prepare("UPDATE RendezVous SET dureeMinutes = :dureeMinutes WHERE idMedecin = :idM AND idClient = :idC AND dateEtHeure = :dateEtHeure");
                        $query->bindParam(':idM', $rendezVous->getIdMedecin());
                        $query->bindParam(':idC', $rendezVous->getIdClient());
                        $query->bindParam(':dateEtHeure', $rendezVous->getDateEtHeure());
                        $query->bindParam(':dureeMinutes', $rendezVous->getDureeMinutes());

                        // execution
                        $query->execute();
                    } else {
                        throw new Exception("Medecin non disponible");
                    }
                } else {
                    throw new Exception("RendezVous inexistant");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // supprime un rendezVous
        public static function remRendezVous(RendezVous $rendezVous) {
            
            try {
                if (self::getById($rendezVous->getIdMedecin(), $rendezVous->getIdClient(), $rendezVous->getDateEtHeure()) != null) {
                    // requete
                    $query = self::getBD()->prepare("DELETE FROM RendezVous WHERE idMedecin = :idM AND idClient = :idC AND dateEtHeure = :dateEtHeure");
                    $query->bindParam(':idM', $rendezVous->getIdMedecin());
                    $query->bindParam(':idC', $rendezVous->getIdClient());
                    $query->bindParam(':dateEtHeure', $rendezVous->getDateEtHeure());

                    // execution
                    $query->execute();
                } else {
                    throw new Exception("RendezVous inexistant");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // get tous les rendezVous
        public static function getAll() {
    
            // requete
            $query = self::getBD()->prepare("SELECT * FROM RendezVous");

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