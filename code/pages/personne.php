<<?php
    class Personne {
        private $idPersonne;
        private $nom;
        private $prenom;
        private $civilite;

        public function __construct($idPersonne, $nom, $prenom, $civilite) {
            $this->idPersonne = $idPersonne;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->civilite = $civilite;
        }

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

        public function setIdPersonne($id) {
            $this->idPersonne = $idPersonne;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }

        public function setPrenom($prenom) {
            $this->prenom = $prenom;
        }

        public function setCivilite($civilite) {
            $this->civilite = $civilite;
        }
    }
?>