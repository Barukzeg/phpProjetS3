<html>
    <body>
        <?php
            include "../../services/serviceUsager.php";
            include "../../services/serviceMedecin.php";
            include "../../services/serviceRendezVous.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $idM = $_POST['idM'];
                $idC = $_POST['idC'];
                $DateEtHeure = new DateTime($_POST['DateEtHeure']);
                $medecin = serviceMedecin::getService()->get($idM)->getNom(). ' ' .serviceMedecin::getService()->get($idM)->getPrenom();
                $client = serviceUsager::getService()->get($idC)->getNom(). ' ' .serviceUsager::getService()->get($idC)->getPrenom();
                $dateHeure = $DateEtHeure->format('Y-m-d') .' à ' .$DateEtHeure->format('H:i');
                $resultat = serviceRendezVous::getService()->delete($idM, $idC, $DateEtHeure);
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
                            echo "<h2>Rendez vous de : ".$client." avec ".$medecin." le ".$dateHeure." supprimé.</h2>";
                        } else {
                            echo "<h2>Erreur dans la requête de supression du rendez-vous.</h2>";
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
