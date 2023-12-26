<?php
    
    include 'medecin.php';
    include 'usager.php';

    class RendezVous {

        private int $idMedecin;
        private int $idClient;
        private DateTime $dateEtHeure;
        private int $dureeMinutes;

        // Constructeur
        public function __construct(int $idMedecin, int $idClient, DateTime $dateEtHeure, int $dureeMinutes) {
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

        public function setDateEtHeure(DateTime $dateEtHeure) {
            $this->dateEtHeure = $dateEtHeure;
        }

        public function setDureeMinutes(int $dureeMinutes) {
            $this->dureeMinutes = $dureeMinutes;
        }
    }
?>