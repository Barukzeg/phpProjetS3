<html>
    <body>
        <h1>Usagers :</h1>
        <?php
            include "../../modele/bdd.php";
            include "../../modele/usager.php";

            ///Connexion au serveur MySQL
            $server = "localhost";
            $db="cabinet_medical";
            $login="root";
            $mdp="";
            try {
                $mysqlClient = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
            }
            catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            };

            $getPersonne = "Select * FROM personne where IdPersonne in (SELECT IdUsager FROM usager)";
            $resultat = $mysqlClient->query($getPersonne);
            //$resultat = Usager::getAll();

            // Vérifier si la requête a réussi
            if ($resultat) {
                // Afficher les résultats
                echo "<ul>";
                while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>" . $row["nom"] . " - " . $row["prenom"] . "</li>";
                }
                echo "</ul>";
                
            } else {
                // En cas d'erreur dans la requête
                echo "Erreur dans la requête : " . $mysqlClient->error;
            }

        ?>
    </body>
</html>