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

            $listUsagers = RepoUsager::getRepo()->getAll();


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

            foreach ($listUsagers as $user){
                $age = ($usager->getDateNaissance() - new DateInterval()).getYear();
                if (($age) >= $age1 && ($age <= $age2)){
                    
                }
            }
            // requete
            $query = $db->prepare("SELECT p.*, u.idUsager, u.idReferant, u.adresseComplete, u.codePostal, u.dateNaissance, u.lieuNaissance, u.NumSecuriteSociale FROM Personne p INNER JOIN Usager u ON p.idPersonne = u.idUsager WHERE p.civilite = :sexe AND YEAR(CURDATE() - u.dateNaissance) BETWEEN :age1 AND :age2");
            $query->bindParam(':sexe', $sexe);
            $query->bindParam(':age1', $age1);
            $query->bindParam(':age2', $age2);

            // execution
            $query->execute();
            $resultats = $query->fetchAll(PDO::FETCH_ASSOC);

            // remplissage de la liste de tout les usagers
            $liste = array();
            foreach ($resultats as $result) {
                $usager = new Usager($result['idUsager'], $result['nom'], $result['prenom'], $result['civilite'], $result['idReferant'], $result['adresseComplete'], $result['codePostal'], $result['dateNaissance'], $result['lieuNaissance'], $result['NumSecuriteSociale']);
                $liste[$result['idUsager']] = $usager;
            }

            //retour de la liste
            return $liste;
        }
    }
?>