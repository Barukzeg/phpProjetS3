<?php

    include "personne.php";

    class Usager extends Personne {

        private int $idUsager;
        private int $idReferent;
        private string $adresseComplete;
        private string $codePostal;
        private DateTime $dateNaissance;
        private string $lieuNaissance;
        private string $NumSecuriteSociale;

        // Constructeur
        public function __construct(int $idUsager, string $nom, string $prenom, string $civilite, int $idReferent, string $adresseComplete, string $codePostal, DateTime $dateNaissance, string $lieuNaissance, string $NumSecuriteSociale) {
            parent::__construct($idUsager, $nom, $prenom, $civilite);
            $this-> idReferent = $idReferent;
            $this-> adresseComplete = $adresseComplete;
            $this-> codePostal = $codePostal;
            $this-> dateNaissance = $dateNaissance;
            $this-> lieuNaissance = $lieuNaissance;
            $this-> NumSecuriteSociale = $NumSecuriteSociale;
        }

        // Getters
        public function getIdUsager() {
            return parent::getIdPersonne();
        }
        public function getidReferent() {
            return $this->idReferent;
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
        public function setidReferent(int $idReferent) {
            $this->idReferent = $idReferent;
        }
        public function setAdresseComplete(string $adresseComplete) {
            $this->adresseComplete = $adresseComplete;
        }
        public function setCodePostal(string $codePostal) {
            $this->codePostal = $codePostal;
        }
        public function setDateNaissance(DateTime $dateNaissance) {
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