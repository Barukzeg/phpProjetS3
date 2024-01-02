<html>
    <body>
        <?php
            include "../../services/serviceRendezVous.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['idUsager'];
                $nom = serviceRendezVous::getService()->get($id)->getNom();
                $prenom = serviceRendezVous::getService()->get($id)->getPrenom();
                $resultat = serviceRendezVous::getService()->delete($_POST['idUsager']);
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
