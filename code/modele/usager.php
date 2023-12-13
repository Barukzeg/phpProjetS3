<?php
    class Usager extends Personne {

        private $idUsager;
        private $idReferant;
        private $adresseComplete;
        private $codePostal;
        private $dateNaissance;
        private $lieuNaissance;
        private $NumSecuriteSociale;

        // Constructeur
        public function __construct($idUsager, $nom, $prenom, $civilite) {
            parent::__construct($idUsager, $nom, $prenom, $civilite);
            $this-> idReferant = $idReferant;
            $this-> adresseComplete = $adresseComplete;
            $this-> codePostal = $codePostal;
            $this-> dateNaissance = $dateNaissance;
            $this-> lieuNaissance = $lieuNaissance;
            $this-> NumSecuriteSociale = $NumSecuriteSociale;
        }

        // Getters
        public function getIdUsager() {
            return $this->idUsager;
        }
        public function getIdReferant() {
            return $this->idReferant;
        }
        public function getAdresseComplete() {
            return $this->adresseComplete;
        }
        public function getCodePostal() {
            return $this->codePostal;
        }
        public function getDateNaissance() {
            return $this->dateNaissance;
        }
        public function getLieuNaissance() {
            return $this->lieuNaissance;
        }
        public function getNumSecuriteSociale() {
            return $this->NumSecuriteSociale;
        }

        // Setters
        public function setIdUsager($idUsager) {
            $this->idUsager = $idUsager;
        }
        public function setIdReferant($idReferant) {
            $this->idReferant = $idReferant;
        }
        public function setAdresseComplete($adresseComplete) {
            $this->adresseComplete = $adresseComplete;
        }
        public function setCodePostal($codePostal) {
            $this->codePostal = $codePostal;
        }
        public function setDateNaissance($dateNaissance) {
            $this->dateNaissance = $dateNaissance;
        }
        public function setLieuNaissance($lieuNaissance) {
            $this->lieuNaissance = $lieuNaissance;
        }
        public function setNumSecuriteSociale($NumSecuriteSociale) {
            $this->NumSecuriteSociale = $NumSecuriteSociale;
        }


        // Fonctions

        // get un usager par son id
        public static function getById($id) {

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
        public static function getByNumSoc($numSecuriteSociale) {

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
        public function addUsager() {

            // connexion
            $db = BDD::getBDD()->getConnection();
    
            // il existe ?
            $search = Usager::getByNumSoc($this->getNumSecuriteSociale());

            // Si non
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
                $qU = $db->prepare("INSERT INTO Usager (idUsager, idReferant, adresseComplete, codePostal, dateNaissance, lieuNaissance, NumSecuriteSociale) VALUES (:idUsager, :idReferant, :adresseComplete, :codePostal, :dateNaissance, :lieuNaissance, :NumSecuriteSociale)");
                $qU->bindParam(':idUsager', $idPersonne);
                $qU->bindParam(':idReferant', $this->getIdReferant());
                $qU->bindParam(':adresseComplete', $this->getAdresseComplete());
                $qU->bindParam(':codePostal', $this->getCodePostal());
                $qU->bindParam(':dateNaissance', $this->getDateNaissance());
                $qU->bindParam(':lieuNaissance', $this->getLieuNaissance());
                $qU->bindParam(':NumSecuriteSociale', $this->getNumSecuriteSociale());
                
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