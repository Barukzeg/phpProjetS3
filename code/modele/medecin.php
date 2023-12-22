<?php

    include 'code/modele/personne.php';
    
    class Medecin extends Personne {

        private int $idMedecin;

        // Constructeur
        public function __construct(int $idMedecin, string $nom, string $prenom, string $civilite) {
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