<html>
    <body>
        <?php
            include "../../services/serviceUsager.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $resultat = serviceMedecin::getService()->delete($_POST['idUsager']);
                if ($resultat) {
                    echo "Usager : ".$usager->getNom()." ".$usager->getPrenom()." supprimé";
                } else {
                    echo "Erreur dans la requête de supression ";
                }
                echo '
                <div class="bouton-add">
                    <form action="listeUsager.php">
                        <button>Retour à la liste des usagers</button>
                    </form>
                </div>';
            }
        ?>
    </body>
</html>
