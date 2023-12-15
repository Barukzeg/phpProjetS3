<?php

    include 'code/modele/personne.php';

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
    }
?>