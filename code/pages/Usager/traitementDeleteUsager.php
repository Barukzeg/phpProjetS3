<html>
    <body>
        <?php
            include "../../services/serviceUsager.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['idUsager'];
                $nom = serviceUsager::getService()->get($id)->getNom();
                $prenom = serviceUsager::getService()->get($id)->getPrenom();
                $resultat = serviceUsager::getService()->delete($_POST['idUsager']);
                if ($resultat) {
                    echo "Usager : ".$nom." ".$prenom." supprimé";
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
