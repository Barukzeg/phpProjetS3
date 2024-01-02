<html>
    <body>
        <?php
            include_once "../../services/serviceMedecin.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $resultat = serviceMedecin::getService()->delete($_POST['idMedecin']);
                if ($resultat) {
                    echo "Medecin : ".$medecin->getNom()." ".$medecin->getPrenom()." supprimé";
                } else {
                    echo "Erreur dans la requête de supression ";
                }
                echo '
                <div class="bouton-add">
                    <form action="listeMedecin.php">
                        <button>Retour à la liste des medecins</button>
                    </form>
                </div>';
            }
        ?>
    </body>
</html>
