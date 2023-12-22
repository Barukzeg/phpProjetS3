<?php
    
    include 'code/modele/medecin.php';
    include 'code/modele/usager.php';

    class RendezVous {

        private int $idMedecin;
        private int $idClient;
        private date $dateEtHeure;
        private int $dureeMinutes;

        // Constructeur
        public function __construct(int $idMedecin, int $idClient, date $dateEtHeure, int $dureeMinutes) {
            $this->idMedecin = $idMedecin;
            $this->didClientate = $idClient;
            $this->dateEtHeure = $dateEtHeure;
            $this->dureeMinutes = $dureeMinutes;
        }

        // Getters
        public function getIdMedecin() {
            return $this->idMedecin;
        }

        public function getIdClient() {
            return $this->idClient;
        }

        public function getDateEtHeure() {
            return $this->dateEtHeure;
        }

        public function getDureeMinutes() {
            return $this->dureeMinutes;
        }

        // Setters
        public function setIdMedecin(int $idMedecin) {
            $this->idMedecin = $idMedecin;
        }

        public function setIdClient(int $idClient) {
            $this->idClient = $idClient;
        }

        public function setDateEtHeure(date $dateEtHeure) {
            $this->dateEtHeure = $dateEtHeure;
        }

        public function setDureeMinutes(int $dureeMinutes) {
            $this->dureeMinutes = $dureeMinutes;
        }
    }
?>