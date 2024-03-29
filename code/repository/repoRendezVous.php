<?php

    include_once '../../modele/rendezVous.php';
    include_once '../../bd/bdd.php';

    class RepoRendezVous {

        private static ?RepoRendezVous $instance = null;    //singleton
        private BDD $db;

        // Constructeur
        private function __construct() {
            $this->db = BDD::getBDD();
        }

        private static function getBD() {
            return self::getRepo()->db->getConnection();
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
                return new RendezVous($result['idMedecin'], $result['idClient'], new DateTime($result['dateEtHeure']), $result['dureeEnMinutes']);
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
                    $rendezVous[] = new RendezVous($result['idMedecin'], $result['idClient'], new DateTime($result['dateEtHeure']), $result['dureeEnMinutes']);
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
                    $rendezVous[] = new RendezVous($result['idMedecin'], $result['idClient'], new DateTime($result['dateEtHeure']), $result['dureeEnMinutes']);
                }
                return $rendezVous;
            } else {
                return null;
            }
        }

        // get si un medecin est occupé à une date et heure donnée
        private static function isOccupied(int $idM, DateTime $dateEtHeure, int $dureeEnMinutes) {

            $results = self::getByMedecin($idM);

            if ($results != null) {
                // retour d'un booleen pour savoir si le medecin est occupé à la date et heure donnée
                foreach ($results as $rdv) {
                    //dates de debut et fin de la durée donnée
                    $dateInD = new DateTime($dateEtHeure->format('Y-m-d H:i'));
                    $dateInF = new DateTime($dateInD->format('Y-m-d H:i'));
                    $dateInF->add(new DateInterval('PT'.$dureeEnMinutes.'M'));

                    //dates de debut et fin d'un des rendezVous trouvés
                    $dateD = new DateTime($rdv->getDateEtHeure()->format('Y-m-d H:i'));
                    $dateF = new DateTime($dateD->format('Y-m-d H:i'));
                    $dateF->add(new DateInterval('PT'.$rdv->getDureeMinutes().'M'));

                    //si la date de debut de la duree donnée est entre les dates de debut et fin d'un des rendezVous trouvés
                    if ($dateInD >= $dateD && $dateInD < $dateF) {
                        return true;

                    //si la date de fin de la duree donnée est entre les dates de debut et fin d'un des rendezVous trouvés
                    } else if ($dateInF > $dateD && $dateInF <= $dateF) {
                        return true;

                    //si la date de debut et de fin de la duree donnée est entre les dates de debut et fin d'un des rendezVous trouvés
                    } else if ($dateInD <= $dateD && $dateInF >= $dateF) {
                        return true;
                    }
                }
            }
            return false;
        }

        // ajoute un rendezVous
        public static function addRendezVous(RendezVous $rendezVous) {
            try {
                if (self::getById($rendezVous->getIdMedecin(), $rendezVous->getIdClient(), $rendezVous->getDateEtHeure()) == null) {
                    if (!self::isOccupied($rendezVous->getIdMedecin(), $rendezVous->getDateEtHeure(), $rendezVous->getDureeMinutes())) {
                        // requete
                        $query = self::getBD()->prepare("INSERT INTO RendezVous (idMedecin, idClient, dateEtHeure, dureeEnMinutes) 
                        VALUES (:idM, :idC, :dateEtHeure, :dureeEnMinutes)");
                        $idM = $rendezVous->getIdMedecin();
                        $query->bindParam(':idM', $idM);
                        $idC = $rendezVous->getIdClient();
                        $query->bindParam(':idC', $idC);
                        $dateEtHeure = $rendezVous->getDateEtHeure()->format('Y-m-d H:i');
                        $query->bindParam(':dateEtHeure', $dateEtHeure);
                        $dureeEnMinutes = $rendezVous->getDureeMinutes();
                        $query->bindParam(':dureeEnMinutes', $dureeEnMinutes);

                        // execution
                        return $query->execute();
                    } else {
                        throw new Exception("Medecin non disponible");
                    }
                } else {
                    throw new Exception("RendezVous déjà existant");
                }
            } catch (Exception $e) {
                header('Location: /phpProjetS3/code/pages/erreur.php');
                exit();
            }
        }

        // modifie un rendezVous
        public static function updateRendezVous(RendezVous $rendezVous, DateTime $NdateEtHeure, int $dureeMinutes) {
    
            try {
                if (self::getById($rendezVous->getIdMedecin(), $rendezVous->getIdClient(), $rendezVous->getDateEtHeure()) != null) {
                    if ($rendezVous->getDateEtHeure() == $NdateEtHeure && $rendezVous->getDureeMinutes() == $dureeMinutes) {
                        return true;
                    } else if (!self::isOccupied($rendezVous->getIdMedecin(), $NdateEtHeure, $dureeMinutes)) {
                        // requete
                        $query = self::getBD()->prepare("UPDATE RendezVous 
                                                            SET dureeEnMinutes = :dureeEnMinutes
                                                            WHERE idMedecin = :idM 
                                                            AND idClient = :idC 
                                                            AND dateEtHeure = :dateEtHeure");
                        $idM = $rendezVous->getIdMedecin();
                        $query->bindParam(':idM', $idM);
                        $idC = $rendezVous->getIdClient();
                        $query->bindParam(':idC', $idC);
                        $dateEtHeure = $rendezVous->getDateEtHeure()->format('Y-m-d H:i');
                        $query->bindParam(':dateEtHeure', $dateEtHeure);
                        $query->bindParam(':dureeEnMinutes', $dureeMinutes);

                        // execution
                        return $query->execute();

                        // requete
                        $query2 = self::getBD()->prepare("UPDATE RendezVous 
                                                            SET dateEtHeure = :NdateEtHeure
                                                            WHERE idMedecin = :idM 
                                                            AND idClient = :idC 
                                                            AND dateEtHeure = :dateEtHeure");
                        $query2->bindParam(':idM', $idM);
                        $query2->bindParam(':idC', $idC);
                        $query2->bindParam(':dateEtHeure', $dateEtHeure);
                        $NdateEtHeure = $NdateEtHeure->format('Y-m-d H:i');
                        $query2->bindParam(':NdateEtHeure', $NdateEtHeure);

                        // execution
                        return $query2->execute();
                    } else {
                        throw new Exception("Medecin non disponible");
                    }
                } else {
                    throw new Exception("RendezVous inexistant");
                }
            } catch (Exception $e) {
                header('Location: /phpProjetS3/code/pages/erreur.php');
                exit();
            }
        }

        // supprime un rendezVous
        public static function remRendezVous(RendezVous $rendezVous) {
            
            try {
                if (self::getById($rendezVous->getIdMedecin(), $rendezVous->getIdClient(), $rendezVous->getDateEtHeure()) != null) {
                    // requete
                    $query = self::getBD()->prepare("DELETE FROM RendezVous WHERE idMedecin = :idM AND idClient = :idC AND dateEtHeure = :dateEtHeure");
                    $idM = $rendezVous->getIdMedecin();
                    $query->bindParam(':idM', $idM);
                    $idC = $rendezVous->getIdClient();
                    $query->bindParam(':idC', $idC);
                    $dateEtHeure = $rendezVous->getDateEtHeure()->format('Y-m-d H:i');
                    $query->bindParam(':dateEtHeure', $dateEtHeure);

                    // execution
                    return $query->execute();
                } else {
                    throw new Exception("RendezVous inexistant");
                }
            } catch (Exception $e) {
                header('Location: /phpProjetS3/code/pages/erreur.php');
                exit();
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
                    $rendezVous[] = new RendezVous($row['idMedecin'], $row['idClient'], new DateTime($row['dateEtHeure']), $row['dureeEnMinutes']);
                }
                return $rendezVous;
            } else {
                return null;
            }
        }
    }
?>