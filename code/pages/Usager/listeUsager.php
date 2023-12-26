<html>
    <head>
        <title>Liste des usagers</title>
        <link rel="stylesheet" href="../../style/style.css">
    </head>
    <?php include "header.php"; ?>
    <body>
        <h1>Usagers :</h1>
        <?php
            include "../../services/serviceUsager.php";

            $resultat = serviceUsager::getService()->getUsagerAlpha();

            // Vérifier si la requête a réussi
            
            if ($resultat) {
                // Afficher les résultats
                echo '<div class="affichageResult">';
                foreach ($resultat as $row) {
                    echo '<div class="result">' . $row["nom"] . ' - ' . $row["prenom"] . '</div>';
                }
                echo "</div>";
                
            } else {
                // En cas d'erreur dans la requête
                echo "Erreur dans la requête : " . $mysqlClient->error;
            }
            
        ?>
        <div class="bouton-add">
            <form action="addUsager.php">
                <button>Ajouter un usager</button>
            </form>
        </div>
    </body>
</html>