<html>
    <body>
        <?php
            include "../../services/serviceUsager.php";
            include "../../services/serviceMedecin.php";
            include "../../services/serviceRendezVous.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $idM = $_POST['idM'];
                $idC = $_POST['idC'];
                $NdateEtHeure = DateTime::createFromFormat('Y-m-d H:i', $_POST['dateRDV'] . ' ' . $_POST['heureRDV']);
                $dateEtHeure = $_POST['DateEtHeure'];
                $dureeMinutes = $_POST['dureeRDV'];
                $resultat = serviceRendezVous::getService()->update($_POST['idM'], $_POST['idC'], new DateTime($_POST['DateEtHeure']), $NdateEtHeure, $dureeMinutes);
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
                            echo '<h2>Les données suivantes ont été modifiées :</h2>';
                            echo '<p><strong>Usager :</strong> '.serviceUsager::get($idC)->getNom().' '.serviceUsager::get($idC)->getPrenom().'</p>';
                            echo '<p><strong>Médecin :</strong> '.serviceMedecin::get($idM)->getNom().' '.serviceMedecin::get($idM)->getPrenom().'</p>';
                            echo '<p><strong>Date :</strong> '.$NdateEtHeure->format('Y-m-d').'</p>';
                            echo '<p><strong>Heure :</strong> '.$NdateEtHeure->format('H:i').'</p>';
                            echo '<p><strong>Durée :</strong> '.$dureeMinutes.' min</p>';
                        } else {
                            echo "<h2>Erreur dans la requête de modification d'un rendez-vous<h2>" ;
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
