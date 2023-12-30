<?php

    include_once '../../modele/medecin.php';
    include_once '../../bd/bdd.php';

    class RepoMedecin {

        private static ?RepoMedecin $instance = null;    //singleton
        private BDD $db;

        // Constructeur
        public function __construct() {
            $this->db = BDD::getBDD();
        }

        private static function getBD() {
            return self::getRepo()->db->getConnection();
        }

        public static function getRepo() {
            if (self::$instance == null) {
                self::$instance = new RepoMedecin();
            }
            return self::$instance;
        }

        // Fonctions

        // get un médecin par son id
        public static function getById(int $id) {

            // $query = self::getBD()->prepare("SELECT * FROM Medecin WHERE idMedecin = :id");
            // requete
            $query = self::getBD()->prepare("SELECT p.*, m.*
                                                FROM Personne p, Medecin m
                                                WHERE p.idPersonne = m.idMedecin
                                                AND m.idMedecin = :id");
            $query->bindParam(':id', $id);

            // execution
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // retour d'une instance de Medecin
            if ($result) {
                return new Medecin($result['idMedecin'], $result['nom'], $result['prenom'], $result['civilite']);
            } else {
                return null;
            }
        }

        // get tous les medecins
        public static function getAll() {
    
            // requete
            $query = self::getBD()->prepare("SELECT m.*, p.* 
                                                FROM Medecin m, Personne p 
                                                WHERE m.idMedecin = p.idPersonne");

            // execution
            $query->execute();
            $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // remplissage de la liste de tout les medecins
            $liste = array();
            foreach ($resultats as $result) {
                $medecin = new Medecin($result['idMedecin'], $result['nom'], $result['prenom'], $result['civilite']);
                $liste[$result['idMedecin']] = $medecin;
            }
            
            //retour de la liste
            return $liste;
        }

        public static function isPresent(string $nom, string $prenom) {
    
            // requete
            $query = self::getBD()->prepare("SELECT p.*, m.* 
                                                FROM Personne p, Medecin m 
                                                WHERE p.idPersonne = m.idMedecin 
                                                AND p.nom = :nom AND p.prenom = :prenom");
            $query->bindParam(':nom', $nom);
            $query->bindParam(':prenom', $prenom);

            // execution
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            // retour d'un booleen pour savoir si le medecin est présent dans la bd
            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        // ajoute un medecin
        public static function addMedecin(Medecin $medecin) {
    
            try {
                // il existe ?
                $search = RepoMedecin::isPresent($medecin->getNom(), $medecin->getPrenom());

                // Si non
                if (!$search) {

                    // insertion personne
                    $qP = self::getBD()->prepare("INSERT INTO Personne (nom, prenom, civilite) 
                                                                VALUES (:nom, :prenom, :civilite)");
                    $nom = $medecin->getNom();
                    $qP->bindParam(':nom', $nom);
                    $prenom = $medecin->getPrenom();
                    $qP->bindParam(':prenom', $prenom);
                    $civilite = $medecin->getCivilite();
                    $qP->bindParam(':civilite', $civilite);

                    $qP->execute();
            
                    // get l'id de la personne insérée 
                    $idPersonne = self::getBD()->lastInsertId();
            
                    // Insérer dans la table Medecin
                    $qM = self::getBD()->prepare("INSERT INTO Medecin (idMedecin) 
                                                                    VALUES (:idMedecin)");
                    $qM->bindParam(':idMedecin', $idPersonne);
                    
                    return $qM->execute();

                } else {
                    throw new Exception("Ce medecin existe déjà.");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // update un medecin
        public static function updateMedecin(Medecin $medecin) {
    
            try {
                // il existe ?
                $search = RepoMedecin::isPresent($medecin->getNom(), $medecin->getPrenom());

                // Si oui
                if ($search) {

                    // update personne
                    $qP = self::getBD()->prepare("UPDATE Personne 
                                                    SET nom = :nom, prenom = :prenom, civilite = :civilite 
                                                    WHERE idPersonne = :idMedecin");
                    $qP->bindParam(':nom', $medecin->getNom());
                    $qP->bindParam(':prenom', $medecin->getPrenom());
                    $qP->bindParam(':civilite', $medecin->getCivilite());
                    $qP->bindParam(':idMedecin', $medecin->getIdMedecin());

                    return $qP->execute();

                } else {
                    throw new Exception("Ce medecin n'existe pas dans la base de données.");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public static function getUsagers(Medecin $medecin){

            try {
                // il existe ?
                $search = RepoMedecin::isPresent($medecin->getNom(), $medecin->getPrenom());

                // Si oui
                if ($search) {

                    // requete
                    $query = self::getBD()->prepare("SELECT u.*, p.* 
                                                        FROM Usager u, Personne p 
                                                        WHERE u.idUsager = p.idPersonne 
                                                        AND u.idReferent = :idReferant");
                    $idMedecin = $medecin->getIdMedecin();
                    $query->bindParam(':idReferant', $idMedecin);

                    // execution
                    $query->execute();
                    $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
            
                    // remplissage de la liste de tout les usagers
                    $liste = array();
                    foreach ($resultats as $result) {
                        $usager = new Usager($result['idUsager'], $result['nom'], $result['prenom'], $result['civilite'], $result['dateNaissance'], $result['adresse'], $result['telephone'], $result['idReferant']);
                        $liste[$result['idUsager']] = $usager;
                    }
                    
                    //retour de la liste
                    return $liste;

                } else {
                    throw new Exception("Ce medecin n'existe pas dans la base de données.");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // retire un medecin
        public static function remMedecin(Medecin $medecin) {
            try {
                // il existe ?
                $search = RepoMedecin::isPresent($medecin->getNom(), $medecin->getPrenom());

                // Si oui
                if ($search) {
                    
                    if (count(self::getUsagers($medecin)) > 0) {
                        throw new Exception("Ce medecin est référent d'au moins un usager, il ne peut donc pas être supprimé.");
                    } else {
                        // supprimer dans la table Medecin
                        $qM = self::getBD()->prepare("DELETE FROM Medecin WHERE idMedecin = :idMedecin");
                        $idMedecin = $medecin->getIdMedecin();
                        $qM->bindParam(':idMedecin', $idMedecin);

                        $qM->execute();

                        // supprimer la personne
                        $qP = self::getBD()->prepare("DELETE FROM Personne WHERE idPersonne = :idMedecin");
                        $qP->bindParam(':idMedecin', $idMedecin);

                        return $qP->execute();
                    }

                } else {
                    throw new Exception("Ce medecin n'existe pas dans la base de données.");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
?>