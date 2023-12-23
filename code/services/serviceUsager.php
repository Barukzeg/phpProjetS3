<?php

    include "../../repository/repoUsager.php";

    class ServiceUsager {

        private static ?ServiceUsager $instance = null;    //singleton

        // Constructeur
        private function __construct() {}

        public static function getService() {
            if (self::$instance === null) {
                self::$instance = new ServiceUsager();
            }
            return self::$instance;
        }

        // Fonctions

        // get tous les usagers par age et sexe (0 = homme, 1 = femme) et age (0 = <25, 1 = 25-50, 2 = 50>)
        public function getUsagerAgeSexe(int $age, int $civilite) {

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

            return $listeFinale;
        }

        //fonction qui retourne tout les usagers, triés par ordre alphabétique
        public function getUsagerAlpha() {

            //récupération des usagers
            $listUsagers = RepoUsager::getRepo()->getAll();

            function tri($user1, $user2){
                $sorted = strcmp($user1->getNom(), $user2->getNom());
                if ($sorted == 0){
                    $sorted = strcmp($user1->getPrenom(), $user2->getPrenom());
                }
                return $sorted;
            }

            //tri des usagers
            usort($listUsagers, "tri");

            return $listUsagers;
        }
    }
?>