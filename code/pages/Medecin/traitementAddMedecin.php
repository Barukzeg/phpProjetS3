<html>
    <body>
        <?php
            include "../../services/serviceMedecin.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nom = ucfirst($_POST['nom']);
                $prenom = ucfirst($_POST['prenom']);
                $civilite = $_POST['civilite'];
                $resultat = serviceMedecin::getService()->add($nom, $prenom, $civilite);
                echo '
                <html>
                <!DOCTYPE HTML>
                <head>
                    <title>Erreur</title>
                    <link rel="stylesheet" href="/phpProjetS3/code/style/styleTrans.css">
                </head>
                <body>
                    <div class="container">
                        ';
                        if ($resultat) {
                            echo '<h2>Les données suivantes ont été enregistré :</h2>';
                            echo '<p><strong>Nom :</strong> '.$nom.'</p>';
                            echo '<p><strong>Prénom :</strong> '.$prenom.'</p>';
                            echo '<p><strong>Civilité :</strong> '.$civilite.'</p>';
                        } else {
                            echo "<h2>Erreur dans la requête d'ajout du medecin.</h2>" ;
                        }.
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
