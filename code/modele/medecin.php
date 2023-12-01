<?php
    class Medecin extends Personne {

        private $idMedecin;

        public function __construct($idMedecin, $nom, $prenom, $civilite) {
            parent::__construct($idMedecin, $nom, $prenom, $civilite);
        }

        public function getIdMedecin() {
            return $this->idMedecin;
        }

        public function setIdMedecin($idMedecin) {
            $this->idMedecin = $idMedecin;
        }
    }
?>