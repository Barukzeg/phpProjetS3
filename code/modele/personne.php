<?php
    class Personne {
        private int $idPersonne;
        private string $nom;
        private string $prenom;
        private string $civilite;

        // Constructeur
        public function __construct(int $idPersonne, string $nom, string $prenom, string $civilite) {
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
        public function setNom(string $nom) {
            $this->nom = $nom;
        }
        public function setPrenom(string $prenom) {
            $this->prenom = $prenom;
        }
        public function setCivilite(string $civilite) {
            $this->civilite = $civilite;
        }
    }
?>