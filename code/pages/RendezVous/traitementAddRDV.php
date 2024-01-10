<html>
    <body>
        <?php
            include_once "../../services/serviceUsager.php";
            include_once "../../services/serviceMedecin.php";
            include_once "../../services/serviceRendezVous.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $idC = $_POST['usager'];
                $idM = $_POST['medecin'];
                $dateEtHeure = DateTime::createFromFormat('Y-m-d H:i', $_POST['dateRDV'] . ' ' . $_POST['heureRDV']);
                $dureeMinutes = $_POST['dureeRDV'];
                $resultat = serviceRendezVous::getService()->add($idM, $idC, $dateEtHeure, $dureeMinutes);
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
                            echo '<h2>Les données suivantes ont été enregistré :</h2>';
                            echo '<p><strong>Usager :</strong> '.serviceUsager::get($idC)->getNom().' '.serviceUsager::get($idC)->getPrenom().'</p>';
                            echo '<p><strong>Médecin :</strong> '.serviceMedecin::get($idM)->getNom().' '.serviceMedecin::get($idM)->getPrenom().'</p>';
                            echo '<p><strong>Date :</strong> '.$dateEtHeure->format('Y-m-d').'</p>';
                            echo '<p><strong>Heure :</strong> '.$dateEtHeure->format('H:i').'</p>';
                            echo '<p><strong>Durée :</strong> '.$dureeMinutes.' min</p>';
                        } else {
                            echo "<h2>Erreur dans la requête d'ajout d'un rendez vous.</h2>" ;
                        }
                        echo '
                        <div class="bouton">
                            <form action="listeRDV.php">
                                <button>Retour à la liste des rendez-vous</button>
                            </form>
                        </div>
                    </div>
                </body>
                </html>';
            }
        ?>
    </body>
</html>
