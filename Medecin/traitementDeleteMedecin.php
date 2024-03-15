<html>
    <body>
        <?php
            include_once "../services/serviceMedecin.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $resultat = serviceMedecin::getService()->delete($_POST['idMedecin']);
                echo '
                <html>
                <!DOCTYPE HTML>
                <head>
                    <link rel="icon" type="image/png" href="../image/logo.ico"/>
                    <title>Erreur</title>
                    <link rel="stylesheet" href="../style/styleTrans.css">
                </head>
                <body>
                    <div class="container">
                        ';
                        if ($resultat) {
                            echo "<h2>Medecin : ".$resultat->getNom()." ".$resultat->getPrenom()." supprimé.</h2>";
                        } else {
                            echo "<h2>Erreur dans la requête de supression du medecin.</h2>";
                        }
                        echo '
                        <div class="bouton">
                            <form action="listeMedecin.php">
                                <button>Retour à la liste des medecins</button>
                            </form>
                        </div>
                    </div>
                </body>
                </html>';
            }
        ?>
    </body>
</html>
