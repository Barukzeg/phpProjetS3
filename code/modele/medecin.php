<?php
    class Medecin extends Personne {

        private $idMedecin;

        // Constructeur
        public function __construct($idMedecin, $nom, $prenom, $civilite) {
            parent::__construct($idMedecin, $nom, $prenom, $civilite);
        }

        // Getters
        public function getIdMedecin() {
            return $this->idMedecin;
        }

        // Setters
        public function setIdMedecin($idMedecin) {
            $this->idMedecin = $idMedecin;
        }


        // Fonctions

        // get un médecin par son id
        public static function getById($id) {

            // connexion
            $db = BDD::getBDD()->getConnection();

            // requete
            $query = $db->prepare("SELECT * FROM Personne p INNER JOIN Medecin m ON p.idPersonne = m.idMedecin WHERE m.idMedecin = :id");
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

        public static function isPresent($nom, $prenom) {

            // connexion
            $db = BDD::getBDD()->getConnection();
    
            // requete
            $query = $db->prepare("SELECT p.*, m.idMedecin FROM Personne p INNER JOIN Medecin m ON p.idPersonne = m.idMedecin WHERE p.nom = :nom AND p.prenom = :prenom");
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
        public function addMedecin() {

            // connexion
            $db = BDD::getBDD()->getConnection();
    
            // il existe ?
            $search = Medecin::isPresent($this->getNom(), $this->getPrenom());

            // Si oui
            if (!$search) {

                // insertion personne
                $qP = $db->prepare("INSERT INTO Personne (nom, prenom, civilite) VALUES (:nom, :prenom, :civilite)");
                $qP->bindParam(':nom', $this->getNom());
                $qP->bindParam(':prenom', $this->getPrenom());
                $qP->bindParam(':civilite', $this->getCivilite());

                $qP->execute();
        
                // get l'id de la personne insérée 
                $idPersonne = $db->lastInsertId();
        
                // Insérer dans la table Usager
                $qM = $db->prepare("INSERT INTO Medecin (idMedecin) VALUES (:idMedecin)");
                $qM->bindParam(':idMedecin', $idPersonne);
                
                $qM->execute();

            } else {
                echo "Ce medecin existe déjà.";
            }
        }
    }
?>