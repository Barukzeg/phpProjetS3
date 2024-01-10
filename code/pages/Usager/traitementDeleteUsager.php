<html>
    <body>
        <?php
            include "../../services/serviceUsager.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['idUsager'];
                $nom = serviceUsager::getService()->get($id)->getNom();
                $prenom = serviceUsager::getService()->get($id)->getPrenom();
                $resultat = serviceUsager::getService()->delete($_POST['idUsager']);
                echo '
                <html>
                    <!DOCTYPE HTML>
                    <head>
                        <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
                        <title>Erreur</title>
                        <link rel="stylesheet" href="/phpProjetS3/code/style/styleTrans.css">
                    </head>
                    <body>
                        <div class="container">
                            ';
                            if ($resultat) {
                                echo "<h2>Usager : ".$nom." ".$prenom." supprimé.</h2>";
                            } else {
                                echo "<h2>Erreur dans la requête de supression de l'usager.</h2>";
                            }
                            echo '
                            <div class="bouton">
                                <form action="listeUsager.php">
                                    <button>Retour à la liste des usagers</button>
                                </form>
                            </div>
                        </div>
                    </body>
                </html>';
            }
        ?>
    </body>
</html>
