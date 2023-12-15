<html>
    <body>
        <h1>Usagers :</h1>
        <?php
            include "../../modele/bdd.php";
            include "../../modele/usager.php";

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