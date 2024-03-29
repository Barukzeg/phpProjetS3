<?php

    include_once "../../modele/usager.php";
    include_once "../../bd/bdd.php";

    class RepoUsager {

        private static ?RepoUsager $instance = null;    //singleton
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
                self::$instance = new RepoUsager();
            }
            return self::$instance;
        }

        // Fonctions

        // get un usager par son id
        public static function getById(int $id) {
    
            // requete
            $query = self::getBD()->prepare("SELECT p.*, u.* 
                                                FROM Personne p, Usager u 
                                                WHERE p.idPersonne = u.idUsager 
                                                AND u.idUsager = :id");
            $query->bindParam(':id', $id);

            // execution
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            // retour d'une instance de Usager
            if ($result) {
                return new Usager($result['idUsager'],
                                 $result['nom'], 
                                 $result['prenom'], 
                                 $result['civilite'], 
                                 $result['idReferent'], 
                                 $result['adresseComplete'], 
                                 $result['codePostal'], 
                                 new DateTime($result['dateNaissance']), 
                                 $result['lieuNaissance'], 
                                 $result['numSecuriteSociale']);
            } else {
                return null;
            }
        }

        // get tous les usagers
        public static function getAll() {
    
            // requete
            $query = self::getBD()->prepare("SELECT p.*, u.* 
                                                FROM Personne p, Usager u
                                                WHERE p.idPersonne = u.idUsager");

            // execution
            $query->execute();
            $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // remplissage de la liste de tout les usagers
            $liste = array();
            foreach ($resultats as $result) {
                $dateNaissance = new DateTime($result['dateNaissance']);
                $usager = new Usager($result['idUsager'], $result['nom'], $result['prenom'], $result['civilite'], $result['idReferent'], $result['adresseComplete'], $result['codePostal'], $dateNaissance, $result['lieuNaissance'], $result['numSecuriteSociale']);
                $liste[$result['idUsager']] = $usager;
            }
            
            //retour de la liste
            return $liste;
        }

        // get un usager par son numéro de sécurité sociale
        public static function getByNumSoc( string $numSecuriteSociale) {
    
            // requete
            $query = self::getBD()->prepare("SELECT p.*, u.* 
                                                FROM Personne p, Usager u 
                                                WHERE p.idPersonne = u.idUsager 
                                                AND u.NumSecuriteSociale = :numSecuriteSociale");
            $query->bindParam(':numSecuriteSociale', $numSecuriteSociale);

            // execution
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            // retour d'une instance de Usager
            if ($result) {
                $result['dateNaissance'] = new DateTime($result['dateNaissance']);
                return new Usager($result['idUsager'], $result['nom'], $result['prenom'], $result['civilite'], $result['idReferent'], $result['adresseComplete'], $result['codePostal'], $result['dateNaissance'], $result['lieuNaissance'], $result['numSecuriteSociale']);
            } else {
                return null;
            }
        }

        // ajoute un usager
        public function addUsager($usager) {
    
            try {
                // il existe ?
                $search = RepoUsager::getByNumSoc($usager->getNumSecuriteSociale());

                // Si non
                if (!$search) {

                    // insertion personne
                    $qP = self::getBD()->prepare("INSERT INTO Personne (nom, prenom, civilite) 
                                                                VALUES (:nom, :prenom, :civilite)");
                    
                    $nom = $usager->getNom();
                    $qP->bindParam(':nom', $nom);
                    $prenom = $usager->getPrenom();
                    $qP->bindParam(':prenom', $prenom);
                    $civilite = $usager->getCivilite();
                    $qP->bindParam(':civilite', $civilite);

                    $qP->execute();
            
                    // get l'id de la personne insérée 
                    $idPersonne = self::getBD()->lastInsertId();
            
                    // Insérer dans la table Usager
                    $qU = self::getBD()->prepare("INSERT INTO Usager (idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, NumSecuriteSociale) 
                                                            VALUES (:idUsager, :idReferent, :adresseComplete, :codePostal, :dateNaissance, :lieuNaissance, :NumSecuriteSociale)");
                    $qU->bindParam(':idUsager', $idPersonne);
                    $idReferent = $usager->getidReferent();
                    $qU->bindParam(':idReferent', $idReferent);
                    $adresseComplete = $usager->getAdresseComplete();
                    $qU->bindParam(':adresseComplete', $adresseComplete);
                    $codePostal = $usager->getCodePostal();
                    $qU->bindParam(':codePostal', $codePostal);
                    $dateNaissance = $usager->getDateNaissance()->format('Y-m-d');
                    $qU->bindParam(':dateNaissance', $dateNaissance);
                    $lieuNaissance = $usager->getLieuNaissance();
                    $qU->bindParam(':lieuNaissance', $lieuNaissance);
                    $numSecuriteSociale = $usager->getNumSecuriteSociale();
                    $qU->bindParam(':NumSecuriteSociale', $numSecuriteSociale);
                    
                    return $qU->execute();

                } else {
                    throw new Exception("Cet usager existe déjà dans la base de données.");
                }
            } catch (Exception $e) {
                header('Location: /phpProjetS3/code/pages/erreur.php');
                exit();
            }
        }

        // update un usager
        public function updateUsager(Usager $usager) {
    
            try {
                // il existe ?
                $search = RepoUsager::getByNumSoc($usager->getNumSecuriteSociale());

                // Si oui
                if ($search) {

                    // update personne
                    $qP = self::getBD()->prepare("UPDATE Personne 
                                                    SET nom = :nom, prenom = :prenom, civilite = :civilite 
                                                    WHERE idPersonne = :idUsager");
                    $nom = $usager->getNom();
                    $qP->bindParam(':nom', $nom);
                    $prenom = $usager->getPrenom();
                    $qP->bindParam(':prenom', $prenom);
                    $civilite = $usager->getCivilite();
                    $qP->bindParam(':civilite', $civilite);
                    $idUsager = $usager->getIdUsager();
                    $qP->bindParam(':idUsager', $idUsager);

                    $qP->execute();
            
                    // update Usager
                    $qU = self::getBD()->prepare("UPDATE Usager 
                                                    SET idReferent = :idReferent, adresseComplete = :adresseComplete, codePostal = :codePostal, dateNaissance = :dateNaissance, lieuNaissance = :lieuNaissance, NumSecuriteSociale = :NumSecuriteSociale 
                                                    WHERE idUsager = :idUsager");
                    $idReferent = $usager->getidReferent();
                    $qU->bindParam(':idReferent', $idReferent);
                    $adresseComplete = $usager->getAdresseComplete();
                    $qU->bindParam(':adresseComplete', $adresseComplete);
                    $codePostal = $usager->getCodePostal();
                    $qU->bindParam(':codePostal', $codePostal);
                    $dateNaissance = $usager->getDateNaissance()->format('Y-m-d');
                    $qU->bindParam(':dateNaissance', $dateNaissance);
                    $lieuNaissance = $usager->getLieuNaissance();
                    $qU->bindParam(':lieuNaissance', $lieuNaissance);
                    $NumSecuriteSociale = $usager->getNumSecuriteSociale();
                    $qU->bindParam(':NumSecuriteSociale', $NumSecuriteSociale);
                    $qU->bindParam(':idUsager', $idUsager);
                    
                    return $qU->execute();

                } else {
                    throw new Exception("Cet usager n'existe pas dans la base de données.");
                }
            } catch (Exception $e) {
                header('Location: /phpProjetS3/code/pages/erreur.php');
                exit();
            }
        }

        // retire un usager
        public function remUsager(Usager $usager) {
    
            try {
                // il existe ?
                $search = RepoUsager::getByNumSoc($usager->getNumSecuriteSociale());

                // Si oui
                if ($search) {
            
                    // supprimer dans la table Usager
                    $qM = self::getBD()->prepare("DELETE FROM Usager WHERE idUsager = :idUsager");
                    $idUsager = $usager->getIdUsager();
                    $qM->bindParam(':idUsager', $idUsager);
                    
                    $qM->execute();

                    // supprimer la personne
                    $qP = self::getBD()->prepare("DELETE FROM Personne WHERE idPersonne = :idUsager");
                    $qP->bindParam(':idUsager', $idUsager);

                    return $qP->execute();

                } else {
                    throw new Exception("Cet usager n'existe pas dans la base de données.");
                }
            } catch (Exception $e) {
                header('Location: /phpProjetS3/code/pages/erreur.php');
                exit();
            }
        }
    }
?>