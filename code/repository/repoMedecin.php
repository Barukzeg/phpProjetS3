<?php

    include '../modele/medecin.php';
    include '../bd/bdd.php';

    class RepoMedecin {

        private static RepoMedecin $instance = null;    //singleton
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
                self::$instance = new RepoMedecin();
            }
            return self::$instance;
        }

        // get un médecin par son id
        public static function getById(int $id) {

            $query = $this->getBD()->prepare("SELECT * FROM Medecin WHERE idMedecin = :id");
            // requete
            $query = $this->getBD()->prepare("SELECT * FROM Personne p INNER JOIN Medecin m ON p.idPersonne = m.idMedecin WHERE m.idMedecin = :id");
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
            $query = $this->getBD()->prepare("SELECT * FROM Medecin");

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
            $query = $this->getBD()->prepare("SELECT p.*, m.idMedecin FROM Personne p INNER JOIN Medecin m ON p.idPersonne = m.idMedecin WHERE p.nom = :nom AND p.prenom = :prenom");
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
        public function addMedecin(Medecin $medecin) {
    
            // il existe ?
            $search = Medecin::isPresent($medecin->getNom(), $medecin->getPrenom());

            // Si non
            if (!$search) {

                // insertion personne
                $qP = $db->prepare("INSERT INTO Personne (nom, prenom, civilite) VALUES (:nom, :prenom, :civilite)");
                $qP->bindParam(':nom', $medecin->getNom());
                $qP->bindParam(':prenom', $medecin->getPrenom());
                $qP->bindParam(':civilite', $medecin->getCivilite());

                $qP->execute();
        
                // get l'id de la personne insérée 
                $idPersonne = $medecin->getBD()->lastInsertId();
        
                // Insérer dans la table Medecin
                $qM = $medecin->getBD()->prepare("INSERT INTO Medecin (idMedecin) VALUES (:idMedecin)");
                $qM->bindParam(':idMedecin', $idPersonne);
                
                $qM->execute();

            } else {
                echo "Ce medecin existe déjà.";
            }
        }

        // retire un medecin
        public function remMedecin() {
    
            // il existe ?
            $search = Medecin::isPresent($this->getNom(), $this->getPrenom());

            // Si oui
            if ($search) {
        
                // supprimer dans la table Medecin
                $qM = $this->getBD()->prepare("DELETE FROM Medecin WHERE idMedecin = :idMedecin");
                $qM->bindParam(':idMedecin', $this->getIdMedecin());
                
                $qM->execute();

                // supprimer la personne
                $qP = $this->getBD()->prepare("DELETE FROM Personne WHERE idPersonne = :idMedecin");
                $qM->bindParam(':idMedecin', $this->getIdMedecin());

                $qP->execute();

            } else {
                echo "Ce medecin n'existe pas dans la base de données.";
            }
        }
    }
?>