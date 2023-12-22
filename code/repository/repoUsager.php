<?php

    include '../../modele/usager.php';
    //include '../../bd/bdd.php';

    class RepoUsager {

        private static ?RepoUsager $instance = null;    //singleton
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
                self::$instance = new RepoUsager();
            }
            return self::$instance;
        }

        // Fonctions

        // get un usager par son id
        public static function getById(int $id) {

            // connexion
            $db = BDD::getBDD()->getConnection();
    
            // requete
            $query = $db->prepare("SELECT p.*, u.idUsager, u.idReferant, u.adresseComplete, u.codePostal, u.dateNaissance, u.lieuNaissance, u.NumSecuriteSociale FROM Personne p INNER JOIN Usager u ON p.idPersonne = u.idUsager WHERE p.idPersonne = :id");
            $query->bindParam(':id', $id);

            // execution
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            // retour d'une instance de Usager
            if ($result) {
                return new Usager($result['idUsager'], $result['nom'], $result['prenom'], $result['civilite'], $result['idReferant'], $result['adresseComplete'], $result['codePostal'], $result['dateNaissance'], $result['lieuNaissance'], $result['NumSecuriteSociale']);
            } else {
                return null;
            }
        }

        // get tous les usagers
        public static function getAll() {

            // connexion
            $db = BDD::getBDD()->getConnection();
    
            // requete
            $query = $db->prepare("SELECT * FROM Usager");

            // execution
            $query->execute();
            $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // remplissage de la liste de tout les usagers
            $liste = array();
            foreach ($resultats as $result) {
                $usager = new Usager($result['idUsager'], $result['nom'], $result['prenom'], $result['civilite'], $result['idReferant'], $result['adresseComplete'], $result['codePostal'], $result['dateNaissance'], $result['lieuNaissance'], $result['NumSecuriteSociale']);
                $liste[$result['idUsager']] = $usager;
            }
            
            //retour de la liste
            return $liste;
        }

        // get un usager par son numéro de sécurité sociale
        public static function getByNumSoc( string $numSecuriteSociale) {

            // connexion
            $db = BDD::getBDD()->getConnection();
    
            // requete
            $query = $db->prepare("SELECT p.*, u.idUsager, u.idReferent, u.adresseComplete, u.codePostal, u.dateNaissance, u.lieuNaissance, u.NumSecuriteSociale FROM Personne p INNER JOIN Usager u ON p.idPersonne = u.idUsager WHERE u.NumSecuriteSociale = :numSecuriteSociale");
            $query->bindParam(':numSecuriteSociale', $numSecuriteSociale);

            // execution
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            // retour d'une instance de Usager
            if ($result) {
                return new Usager($result['idUsager'], $result['nom'], $result['prenom'], $result['civilite'], $result['idReferent'], $result['adresseComplete'], $result['codePostal'], $result['dateNaissance'], $result['lieuNaissance'], $result['NumSecuriteSociale']);
            } else {
                return null;
            }
        }

        // ajoute un usager
        public function addUsager(Usager $usager) {
    
            // il existe ?
            $search = Usager::getByNumSoc($usager->getNumSecuriteSociale());

            // Si non
            if (!$search) {

                // insertion personne
                $qP = $db->prepare("INSERT INTO Personne (nom, prenom, civilite) VALUES (:nom, :prenom, :civilite)");
                $qP->bindParam(':nom', $usager->getNom());
                $qP->bindParam(':prenom', $usager->getPrenom());
                $qP->bindParam(':civilite', $usager->getCivilite());

                $qP->execute();
        
                // get l'id de la personne insérée 
                $idPersonne = $db->lastInsertId();
        
                // Insérer dans la table Usager
                $qU = $db->prepare("INSERT INTO Usager (idUsager, idReferant, adresseComplete, codePostal, dateNaissance, lieuNaissance, NumSecuriteSociale) VALUES (:idUsager, :idReferant, :adresseComplete, :codePostal, :dateNaissance, :lieuNaissance, :NumSecuriteSociale)");
                $qU->bindParam(':idUsager', $idPersonne);
                $qU->bindParam(':idReferant', $usager->getIdReferant());
                $qU->bindParam(':adresseComplete', $thusageris->getAdresseComplete());
                $qU->bindParam(':codePostal', $usager->getCodePostal());
                $qU->bindParam(':dateNaissance', $usager->getDateNaissance());
                $qU->bindParam(':lieuNaissance', $usager->getLieuNaissance());
                $qU->bindParam(':NumSecuriteSociale', $usager->getNumSecuriteSociale());
                
                $qU->execute();

            } else {
                echo "Ce client existe déjà.";
            }
        }

        // retire un usager
        public function remUsager() {

            // connexion
            $db = BDD::getBDD()->getConnection();
    
            // il existe ?
            $search = Usager::getByNumSoc($this->getNumSecuriteSociale());

            // Si oui
            if ($search) {
        
                // supprimer dans la table Usager
                $qM = $db->prepare("DELETE FROM Usager WHERE idUsager = :idUsager");
                $qM->bindParam(':idUsager', $this->getIdUsager());
                
                $qM->execute();

                // supprimer la personne
                $qP = $db->prepare("DELETE FROM Personne WHERE idPersonne = :idUsager");
                $qM->bindParam(':idUsager', $this->getIdUsager());

                $qP->execute();

            } else {
                echo "Cet usager n'existe pas dans la base de données.";
            }
        }
    }
?>