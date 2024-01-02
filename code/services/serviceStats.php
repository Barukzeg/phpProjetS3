<?php

    include_once '../../modele/medecin.php';
    include_once '../../modele/usager.php';
    include_once '../../repository/repoMedecin.php';
    include_once '../../repository/repoUsager.php';
    include_once '../../repository/repoRendezVous.php';

    class ServiceStats {

        private static ?ServiceStats $instance = null;    //singleton

        // Constructeur
        private function __construct() {}

        public static function getService() {
            if (self::$instance === null) {
                self::$instance = new ServiceStats();
            }
            return self::$instance;
        }

        //nombre d'heures de travail d'un medecin
        private function getTotalHeuresMedecin($id) {

            $listeRDV = RepoRendezVous::getRepo()->getByMedecin($id);
            $total = 0;

            foreach ($listeRDV as $rdv) {

                if ($rdv->getDateEtHeure() < new DateTime('now')) {
                    $total += $rdv->getDureeMinutes();
                }
            }

            return $total/60;
        }

        //nombre total d'heure de chaque medecin
        public function getHeuresMedecins() {

            //récupération des medecins
            $listeMedecins = RepoMedecin::getRepo()->getAll();

            $resultats = array();
    
            foreach ($listeMedecins as $medecin) {

                $nom = $medecin->getNom();
                $prenom = $medecin->getPrenom();
                $id = $medecin->getIdMedecin();
                $totalHeures = self::getTotalHeuresMedecin($id);
    
                $resultats[] = array(
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'heures' => $totalHeures
                );
            }

            function tri($med1, $med2) {
                $res = strcmp($med1['nom'], $med2['nom']);
                if ($res == 0) {
                    $res = strcmp($med1['prenom'], $med2['prenom']);
                }
                return $res;
            };

            usort($resultats, "tri");
    
            return $resultats;
        }

        // get le nombre d'usagers par age et sexe (0 = homme, 1 = femme) et age (0 = <25, 1 = 25-50, 2 = 50>)
        public function getCountUsagerAgeSexe(int $age, int $civilite) {

            // gestion des paramètres
            switch ($civilite) {
                case 0:
                    $sexe = "M";
                    break;
                case 1:
                    $sexe = "F";
                    break;
                default:
                    $sexe = "X";
                    break;
            }

            switch ($age) {
                case 0:
                    $age1 = 0;
                    $age2 = 24;
                    break;
                case 1:
                    $age1 = 25;
                    $age2 = 50;
                    break;
                case 2:
                    $age1 = 51;
                    $age2 = 125;
                    break;
                default:
                    $age1 = 0;
                    $age2 = 24;
                    break;
            }

            //récupération des usagers
            $listUsagers = RepoUsager::getRepo()->getAll();

            $listeFinale = array();

            //tri des usagers
            foreach ($listUsagers as $user){
                $ageF = ($user->getDateNaissance()->diff(new DateTime('now')))->y;
                $sexeF = $user->getCivilite();
                if ((($ageF) >= $age1 && ($ageF <= $age2)) && ($sexeF == $sexe)){
                    $listeFinale[] = $user;
                }
            }

            return count($listeFinale);
        }
    }
?>