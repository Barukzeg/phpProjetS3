<<?php
    class Personne {
        private $idPersonne;
        private $nom;
        private $prenom;
        private $civilite;

        // Constructeur
        public function __construct($idPersonne, $nom, $prenom, $civilite) {
            $this->idPersonne = $idPersonne;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->civilite = $civilite;
        }

        // Getters
        public function getIdPersonne() {
            return $this->idPersonne;
        }
        public function getNom() {
            return $this->nom;
        }
        public function getPrenom() {
            return $this->prenom;
        }
        public function getCivilite() {
            return $this->civilite;
        }
        
        // Setters
        public function setNom($nom) {
            $this->nom = $nom;
        }
        public function setPrenom($prenom) {
            $this->prenom = $prenom;
        }
        public function setCivilite($civilite) {
            $this->civilite = $civilite;
        }

        public static function getById($id) {

            // connexion
            $bd = BDD::getBDD() -> getConnection();
    
            // requete
            $query = $db->prepare("SELECT * FROM personnes WHERE idPersonne = :id");
            $query->bindParam(':id', $id);
    
            // execution
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            // retour d'une instance de Personne
            if ($result) {
                return new Personne($result['idPersonne'], $result['nom'], $result['prenom'], $result['civilite']);
            } else {
                return null;
            }
        }
    }
?>