<?php

    include 'personne.php';

    class Usager extends Personne {

        private int $idUsager;
        private int $idReferant;
        private string $adresseComplete;
        private string $codePostal;
        private date $dateNaissance;
        private string $lieuNaissance;
        private string $NumSecuriteSociale;

        // Constructeur
        public function __construct(int $idUsager, string $nom, string $prenom, string $civilite, int $idReferant, string $adresseComplete, string $codePostal, date $dateNaissance, string $lieuNaissance, string $NumSecuriteSociale) {
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
        public function setIdUsager(int $idUsager) {
            $this->idUsager = $idUsager;
        }
        public function setIdReferant(int $idReferant) {
            $this->idReferant = $idReferant;
        }
        public function setAdresseComplete(string $adresseComplete) {
            $this->adresseComplete = $adresseComplete;
        }
        public function setCodePostal(string $codePostal) {
            $this->codePostal = $codePostal;
        }
        public function setDateNaissance(date $dateNaissance) {
            $this->dateNaissance = $dateNaissance;
        }
        public function setLieuNaissance(string $lieuNaissance) {
            $this->lieuNaissance = $lieuNaissance;
        }
        public function setNumSecuriteSociale(string $NumSecuriteSociale) {
            $this->NumSecuriteSociale = $NumSecuriteSociale;
        }
    }
?>