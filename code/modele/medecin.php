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
    }
?>