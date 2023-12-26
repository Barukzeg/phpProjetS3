<html>
    <head>
        <title>Liste des usagers</title>
        <link rel="stylesheet" href="../../style/style.css">
    </head>
    <?php include "../header.php"; ?>
    <body>
        <h1>Usagers :</h1>
        <?php
            include "../../services/serviceUsager.php";

            try{
                $resultat = serviceUsager::getService()->getUsagerAlpha();
                echo '<div class="affichageResult">';
                foreach ($resultat as $row) {
                    echo '<div class="result">' . $row["nom"] . ' - ' . $row["prenom"] . '</div>';
                }
                echo "</div>";
            }catch (Exception $e){
                echo $e->getMessage();
            }
        ?>
        <div class="bouton-add">
            <form action="addUsager.php">
                <button>Ajouter un usager</button>
            </form>
        </div>
    </body>
</html>