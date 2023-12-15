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
    }
?>