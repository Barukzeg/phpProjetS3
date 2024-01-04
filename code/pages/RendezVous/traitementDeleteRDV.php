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
                if ($resultat) {
                    echo "Rendez vous de : ".$client." avec ".$medecin." le ".$dateHeure." supprimé";
                } else {
                    echo "Erreur dans la requête de supression ";
                }
                echo '
                <div class="bouton-add">
                    <form action="listeRDV.php">
                        <button>Retour à la liste des RDV</button>
                    </form>
                </div>';
            }
        ?>
    </body>
</html>
